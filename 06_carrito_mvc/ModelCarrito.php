<?php
include_once "./Producto.php";
class ModelCarrito
{
    public function __construct()
    {
        //accedemos a la sesion web del usuario:
        session_start();
        //validar si ya existe el carrito en la sesion:
        if (!isset($_SESSION['carrito'])) {
            //si no existe, se crea un array nuevo.
            $_SESSION['carrito'] = [];
        }
    }
    
    public function agregarProducto($nombreProducto,$precioUnitario,$cantidad){
        $producto = new Producto($nombreProducto,$precioUnitario,$cantidad);
        session_start();
        $_SESSION['carrito'][]=$producto;
    }

    public function obtenerProductos(){
        session_start();
        return $_SESSION['carrito'];
    }
}
?>