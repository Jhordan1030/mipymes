<?php


require_once '../model/NotaModel.php';
session_start();
$notaModel = new notaModel();
$opcion = $_REQUEST['opcion'];
//limpiamos cualquier mensaje previo:
unset($_SESSION['mensaje']);

switch ($opcion) {
    case "listar":
        //obtenemos la lista de productos:
        $listado = $notaModel->getNotas(true);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "listar_desc":
        //obtenemos la lista de productos:
        $listado = $notaModel->getProductos(false);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        
        header('Location: ../view/index.php');
        break;
    case "crear":
        //navegamos a la pagina de creacion:
        header('Location: ../view/crear.php');
        break;
    case "guardar":
        //obtenemos los valores ingresados por el usuario en el formulario:
        $cedula = $_REQUEST['cedula'];
        $nombres = $_REQUEST['nombres'];
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];
        //creamos un nuevo producto:
        try{
            $productoModel->crearProducto($cedula, $nombres, $nota1, $nota2);
        }catch(Exception $e){
            //colocamos el mensaje de la excepcion en sesion
            $_SESSION['mensaje']=$e->getMessage();
        }
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $notaModel->getNotas(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "eliminar":
        //obtenemos el codigo del producto a eliminar:
        $codigo = $_REQUEST['cedula'];
        //eliminamos el producto:
        $productoModel->eliminarProducto($cedula);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $notaModel->getNotas(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "cargar":
        //para permitirle actualizar un producto al usuario primero
        //obtenemos los datos completos de ese producto:
        $codigo = $_REQUEST['cedula'];
        $nota = $notaModel->getNota($cedula);
        //guardamos en sesion el producto para posteriormente visualizarlo
        //en un formulario para permitirle al usuario editar los valores:
        $_SESSION['nota'] = $nota;
        header('Location: ../view/actualizar.php');
        break;
    case "actualizar":
        //obtenemos los datos modificados por el usuario:
        $codigo = $_REQUEST['cedula'];
        $nombre = $_REQUEST['nombres'];
        $precio = $_REQUEST['nota1'];
        $cantidad = $_REQUEST['nota2'];
        //actualizamos los datos del producto:
        $notaModel->actualizarNota($cedula, $nombres, $nota1, $nota2);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $notaModel->getNotas(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../view/index.php');
}
