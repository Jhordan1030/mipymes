require('dotenv').config();
const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const authRoutes = require('./routes/authRoutes');
const apiRoutes = require('./routes/apiRoutes');
const pool = require('./db');

const app = express();
app.use(express.json());
// Middleware
app.use(cors());
app.use(bodyParser.json());

// Definir las rutas
app.use('/api/auth', authRoutes);
app.use('/api', apiRoutes);

// Función para verificar conexión a PostgreSQL
const connectDB = async () => {
    try {
        const client = await pool.connect();
        console.log("✅ Conectado a PostgreSQL");
        client.release();
    } catch (err) {
        console.error("❌ Error al conectar a PostgreSQL:", err);
        process.exit(1);
    }
};

// Iniciar el servidor
const PORT = process.env.PORT || 5000;
app.listen(PORT, async () => {
    console.log(`✅ Servidor corriendo en http://localhost:${PORT}`);
    await connectDB();
});

// Manejo de errores global
app.use((err, req, res, next) => {
    console.error("❌ Error en el servidor:", err.stack);
    res.status(500).json({ message: 'Error interno del servidor' });
});
