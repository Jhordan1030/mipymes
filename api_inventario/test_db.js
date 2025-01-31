require('dotenv').config();
const pool = require('./db');

(async () => {
    try {
        const result = await pool.query('SELECT NOW()');
        console.log("✅ Conexión exitosa a la base de datos:", result.rows);
    } catch (error) {
        console.error("❌ Error en la conexión a la base de datos:", error);
    }
})();
