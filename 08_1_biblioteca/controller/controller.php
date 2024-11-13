<?php


require_once '../model/ProductoModel.php';
session_start();
$productoModel = new ProductoModel();
$opcion = $_REQUEST['opcion'];
//limpiamos cualquier mensaje previo:
unset($_SESSION['mensaje']);

switch ($opcion) {
    case "listar":
        //obtenemos la lista de productos:
        $listado = $productoModel->getProductos(true);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        //obtenemos el valor total de productos y guardamos en sesion:
        $_SESSION['valorTotal'] = $productoModel->getValorProductos();
        header('Location: ../view/index.php');
        break;
    case "listar_desc":
        //obtenemos la lista de productos:
        $listado = $productoModel->getProductos(false);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        //obtenemos el valor total de productos:
        $_SESSION['valorTotal'] = $productoModel->getValorProductos();
        header('Location: ../view/index.php');
        break;
    case "crear":
        //navegamos a la pagina de creacion:
        header('Location: ../view/crear.php');
        break;
    case "guardar":
        //obtenemos los valores ingresados por el usuario en el formulario:
        $codigo = $_REQUEST['codigo'];
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];
        $cantidad = $_REQUEST['cantidad'];
        //creamos un nuevo producto:
        try{
            $productoModel->crearProducto($codigo, $nombre, $precio, $cantidad);
        }catch(Exception $e){
            //colocamos el mensaje de la excepcion en sesion
            $_SESSION['mensaje']=$e->getMessage();
        }
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $productoModel->getProductos(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "eliminar":
        //obtenemos el codigo del producto a eliminar:
        $codigo = $_REQUEST['codigo'];
        //eliminamos el producto:
        $productoModel->eliminarProducto($codigo);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $productoModel->getProductos(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "cargar":
        //para permitirle actualizar un producto al usuario primero
        //obtenemos los datos completos de ese producto:
        $codigo = $_REQUEST['codigo'];
        $producto = $productoModel->getProducto($codigo);
        //guardamos en sesion el producto para posteriormente visualizarlo
        //en un formulario para permitirle al usuario editar los valores:
        $_SESSION['producto'] = $producto;
        header('Location: ../view/actualizar.php');
        break;
    case "actualizar":
        //obtenemos los datos modificados por el usuario:
        $codigo = $_REQUEST['codigo'];
        $nombre = $_REQUEST['nombre'];
        $precio = $_REQUEST['precio'];
        $cantidad = $_REQUEST['cantidad'];
        //actualizamos los datos del producto:
        $productoModel->actualizarProducto($codigo, $nombre, $precio, $cantidad);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $productoModel->getProductos(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../view/index.php');
}
