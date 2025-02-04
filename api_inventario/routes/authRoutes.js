const express = require('express');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');
const pool = require('../db');
require('dotenv').config();

const router = express.Router();

// 📌 Registro de usuario
router.post('/register', async (req, res) => {
    const { name, email, username, password } = req.body;

    try {
        // ✅ Verificar que todos los campos están presentes
        if (!name || !email || !username || !password) {
            return res.status(400).json({ message: 'Todos los campos (name, email, username, password) son obligatorios' });
        }

        // ✅ Verificar si el usuario o el correo ya existen
        const userExists = await pool.query('SELECT * FROM users WHERE username = $1 OR email = $2', [username, email]);
        if (userExists.rows.length > 0) {
            return res.status(400).json({ message: 'El usuario o el correo ya están registrados' });
        }

        // ✅ Hashear la contraseña
        const salt = await bcrypt.genSalt(10);
        const hashedPassword = await bcrypt.hash(password, salt);

        // ✅ Insertar usuario en la base de datos
        const newUser = await pool.query(
            'INSERT INTO users (name, email, username, password, created_at, updated_at) VALUES ($1, $2, $3, $4, NOW(), NOW()) RETURNING id, username',
            [name, email, username, hashedPassword]
        );

        // ✅ Crear token JWT
        const token = jwt.sign(
            { id: newUser.rows[0].id, username: newUser.rows[0].username },
            process.env.JWT_SECRET,
            { expiresIn: '1h' }
        );

        res.status(201).json({ message: 'Usuario registrado exitosamente', token });
    } catch (error) {
        console.error(error);
        res.status(500).json({ message: 'Error en el servidor', error });
    }
});
router.post('/login', async (req, res) => {
    const { username, password } = req.body;

    try {
        // 📌 Verificar si el usuario existe
        const result = await pool.query('SELECT * FROM users WHERE username = $1', [username]);
        if (result.rows.length === 0) {
            return res.status(401).json({ message: 'Usuario no encontrado' });
        }

        const user = result.rows[0];

        // 📌 Comparar la contraseña ingresada con la almacenada en la base de datos
        const isMatch = await bcrypt.compare(password, user.password);
        if (!isMatch) {
            return res.status(401).json({ message: 'Contraseña incorrecta' });
        }

        // 📌 Crear el token JWT
        const token = jwt.sign(
            { id: user.id, username: user.username },
            process.env.JWT_SECRET,
            { expiresIn: '1h' } // Expira en 1 hora
        );

        res.json({ token });
    } catch (error) {
        res.status(500).json({ message: 'Error en el servidor', error });
    }
});

module.exports = router;
