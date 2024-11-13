<?php
require_once '../model/LibroModel.php';

class Controller {
    
    private $libroModel;

    public function __construct() {
        $this->libroModel = new LibroModel();
    }

    // Método para listar todos los libros
    public function listarLibros() {
        $libros = $this->libroModel->getLibros();
        include '../view/index.php';
    }

    // Método para crear un nuevo libro
    public function crearLibro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = $_POST['codigo'];
            $titulo = $_POST['titulo'];
            $año = $_POST['año'];
            $autor = $_POST['autor'];
            $paginas = $_POST['paginas'];
            $this->libroModel->crearLibro($codigo, $titulo, $año, $autor, $paginas);
            header('Location: index.php');
        } else {
            include '../view/crear.php';
        }
    }

    // Método para actualizar un libro
    public function actualizarLibro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo = $_POST['codigo'];
            $titulo = $_POST['titulo'];
            $año = $_POST['año'];
            $autor = $_POST['autor'];
            $paginas = $_POST['paginas'];
            $this->libroModel->actualizarLibro($codigo, $titulo, $año, $autor, $paginas);
            header('Location: index.php');
        } else {
            $codigo = $_GET['codigo'];
            $libro = $this->libroModel->obtenerLibro($codigo);
            include '../view/actualizar.php';
        }
    }
}
?>
