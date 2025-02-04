const jwt = require('jsonwebtoken');
const pool = require('../db');
require('dotenv').config();

module.exports = async (req, res, next) => {
    let token = req.header('Authorization')?.replace('Bearer ', '');

    if (!token) {
        return res.status(403).json({ message: 'Acceso denegado. Token no proporcionado.' });
    }

    try {
        // Verificar si el token está en la blacklist
        const result = await pool.query('SELECT * FROM blacklist_tokens WHERE token = $1', [token]);
        if (result.rows.length > 0) {
            return res.status(401).json({ message: 'Token inválido. Inicie sesión nuevamente.' });
        }

        // Verificar JWT
        const decoded = jwt.verify(token, process.env.JWT_SECRET);
        req.user = decoded;
        next();
    } catch (error) {
        res.status(401).json({ message: 'Token inválido o expirado' });
    }
};
