<?php
/**
 * Clase utilitaria que maneja la conexión y desconexión a la base de datos
 * mediante PDO (PHP Data Objects).
 * Utiliza el patrón de diseño Singleton para el manejo de la conexión.
 * 
 * @author mrea
 */
class Database {
    // Propiedades estáticas con la información de la conexión (DSN):
    private static $dbName = 'biblioteca';       // Nombre de la base de datos
    private static $dbHost = 'localhost';       // Host del servidor de la base de datos
    private static $dbUsername = 'jmhueran';    // Usuario de la base de datos
    private static $dbUserPassword = 'jmhueran';// Contraseña del usuario
    
    // Propiedad para controlar la conexión:
    private static $conexion = null;

    /**
     * No se permite instanciar esta clase, se utilizan sus elementos
     * de tipo estático.
     */
    public function __construct() {
        exit('No se permite instanciar esta clase. Solo se usan sus métodos estáticamente.');
    }

    /**
     * Método estático que crea una conexión a la base de datos.
     * Si ya existe una conexión, la reutiliza (Singleton).
     * 
     * @return PDO La conexión a la base de datos
     */
    public static function connect() {
        // Si no hay una conexión establecida, se crea una nueva (patrón Singleton)
        if (self::$conexion == null) {
            try {
                self::$conexion = new PDO(
                    "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, 
                    self::$dbUsername, 
                    self::$dbUserPassword
                );
                // Configurar el modo de error de PDO para excepciones
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Si ocurre un error en la conexión, se muestra el mensaje y se termina el script
                die("Error de conexión: " . $e->getMessage());
            }
        }
        return self::$conexion;
    }

    /**
     * Método estático para desconectar de la base de datos.
     * 
     * Destruye la conexión establecida.
     */
    public static function disconnect() {
        self::$conexion = null;
    }
}
?>
