<?php
///////////////////////////////////////////////////////////////////////
//Componente controller que verifica la opcion seleccionada
//por el usuario, ejecuta el modelo y enruta la navegacion de paginas.
///////////////////////////////////////////////////////////////////////

require_once '../model/NotaModel.php';
session_start();
$notaModel = new NotaModel();
$opcion = $_REQUEST['opcion'];
//limpiamos cualquier mensaje previo:
unset($_SESSION['mensaje']);

switch ($opcion) {
    case "listar":
        //obtenemos la lista de productos:
        $listado = $notaModel->getNotas(true);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        //obtenemos el valor total de productos y guardamos en sesion:
        $_SESSION['promedioGeneral'] = $nota->getPromedioGeneral();
        header('Location: ../view/index.php');
        break;
    case "listar_desc":
        //obtenemos la lista de productos:
        $listado = $notaModel->getNotas(false);
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        //obtenemos el valor total de productos:
        $_SESSION['promedioGeneral'] = $not->getPromedioGeneral();
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
            $notaModel->crearNota($cedula, $nombres, $nota1, $nota2);
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
        $cedula = $_REQUEST['cedula'];
        //eliminamos el producto:
        $notaModel->eliminarNota($cedula);
        //actualizamos la lista de productos para grabar en sesion:
        $listado = $notaModel->getNotas(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "cargar":
        //para permitirle actualizar un producto al usuario primero
        //obtenemos los datos completos de ese producto:
        $cedula = $_REQUEST['cedula'];
        $nota = $notaModel->getNota($cedula);
        //guardamos en sesion el producto para posteriormente visualizarlo
        //en un formulario para permitirle al usuario editar los valores:
        $_SESSION['nota'] = $nota;
        header('Location: ../view/actualizar.php');
        break;
    case "actualizar":
        //obtenemos los datos modificados por el usuario:
        $cedula = $_REQUEST['cedula'];
        $nombres = $_REQUEST['nombres'];
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];
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
