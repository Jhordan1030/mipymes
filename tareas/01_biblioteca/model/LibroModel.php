<?php
require_once 'Database.php';

class LibroModel {
    
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // Método para obtener todos los libros
    public function getLibros() {
        $query = "SELECT * FROM libro";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para agregar un libro
    public function crearLibro($codigo, $titulo, $año, $autor, $paginas) {
        $query = "INSERT INTO libro (lib_codigo, lib_titulo, lib_año, lib_autor, lib_paginas) VALUES (:codigo, :titulo, :año, :autor, :paginas)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':año', $año);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':paginas', $paginas);
        $stmt->execute();
    }

    // Método para actualizar un libro
    public function actualizarLibro($codigo, $titulo, $año, $autor, $paginas) {
        $query = "UPDATE libro SET lib_titulo = :titulo, lib_año = :año, lib_autor = :autor, lib_paginas = :paginas WHERE lib_codigo = :codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':año', $año);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':paginas', $paginas);
        $stmt->execute();
    }

    // Método para obtener un libro por su código
    public function obtenerLibro($codigo) {
        $query = "SELECT * FROM libro WHERE lib_codigo = :codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para eliminar un libro
    public function eliminarLibro($codigo) {
        $query = "DELETE FROM libro WHERE lib_codigo = :codigo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':codigo', $codigo);
        $stmt->execute();
    }
}
?>
