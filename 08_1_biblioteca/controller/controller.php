<?php


require_once '../model/LibroModel.php';
session_start();
$libroModel = new LibroModel();
$opcion = $_REQUEST['opcion'];
//limpiamos cualquier mensaje previo:
unset($_SESSION['mensaje']);

switch ($opcion) {
    case "listar":
        //obtenemos la lista de productos:
        $listado = $libroModel->getLibros();
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
        $lib_codigo = $_REQUEST['lib_codigo'];
        $lib_titulo = $_REQUEST['lib_titulo'];
        $lib_año = $_REQUEST['lib_año'];
        $lib_autor = $_REQUEST['lib_autor'];
        $lib_paginas = $_REQUEST['lib_paginas'];
        //creamos un nuevo producto:
        try {
            $libroModel->crearLibro($lib_codigo, $lib_titulo, $lib_año, $lib_autor, $lib_paginas);
        } catch (Exception $e) {
            //colocamos el mensaje de la excepcion en sesion
            $_SESSION['mensaje'] = $e->getMessage();
        }
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $libroModel->getLibros(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "eliminar":
        //obtenemos el codigo del producto a eliminar:
        $lib_codigo = $_REQUEST['lib_codigo'];
        //eliminamos el producto:
        $libroModel->eliminarLibro($lib_codigo);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $libroModel->getLibros(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "cargar":
        //para permitirle actualizar un producto al usuario primero
        //obtenemos los datos completos de ese producto:
        $lib_codigo = $_REQUEST['lib_codigo'];
        $libro = $libroModel->getLibro($lib_codigo);
        //guardamos en sesion el producto para posteriormente visualizarlo
        //en un formulario para permitirle al usuario editar los valores:
        $_SESSION['libro'] = $libro;
        header('Location: ../view/actualizar.php');
        break;
    case "actualizar":
        //obtenemos los datos modificados por el usuario:
        $lib_codigo = $_REQUEST['lib_codigo'];
        $lib_titulo = $_REQUEST['lib_titulo'];
        $lib_año = $_REQUEST['lib_año'];
        $lib_autor = $_REQUEST['lib_autor'];
        $lib_paginas = $_REQUEST['lib_paginas'];
        //actualizamos los datos del producto:
        $libroModel->actualizarlibro($lib_codigo, $lib_titulo, $lib_año, $lib_autor, $lib_paginas);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $libroModel->getLibros(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../view/index.php');
}
