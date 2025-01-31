// routes/apiRoutes.js
const express = require('express');
const pool = require('../db');
const authMiddleware = require('../middleware/auth');

const router = express.Router();

router.get('/consulta1', authMiddleware, async (req, res) => {
    try {
        const result = await pool.query('SELECT codigo, tiponota, fechanota FROM tipo_nota');
        res.json(result.rows);
    } catch (error) {
        res.status(500).json({ message: 'Error al obtener datos', error });
    }
});

router.get('/consulta2', authMiddleware, async (req, res) => {
    try {
        const result = await pool.query(`
            SELECT tn.codigo, tn.tiponota, e.nombreemp AS empleado, b.nombrebodega AS bodega
            FROM tipo_nota tn
                     LEFT JOIN empleados e ON tn.idempleado = e.idempleado
                     LEFT JOIN bodegas b ON tn.idbodega = b.idbodega
        `);
        res.json(result.rows);
    } catch (error) {
        res.status(500).json({ message: 'Error al obtener datos', error });
    }
});

module.exports = router;