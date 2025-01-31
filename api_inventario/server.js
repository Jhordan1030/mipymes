// server.js
require('dotenv').config();
const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');
const authRoutes = require('./routes/authRoutes');
const apiRoutes = require('./routes/apiRoutes');
const pool = require('./db');

const app = express();

app.use(cors());
app.use(bodyParser.json());

app.use('/api/auth', authRoutes);
app.use('/api', apiRoutes);

const PORT = process.env.PORT || 5000;
app.listen(PORT, async () => {
    try {
        await pool.connect();
        console.log("✅ Servidor corriendo en http://localhost:" + PORT);
        console.log("✅ Conectado a PostgreSQL");
    } catch (err) {
        console.error("❌ Error al conectar a PostgreSQL:", err);
    }
});