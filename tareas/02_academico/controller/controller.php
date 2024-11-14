<?php


require_once '../model/NotaModel.php';
session_start();
$notaModel = new NotaModel();
$opcion = $_REQUEST['opcion'];
//limpiamos cualquier mensaje previo:
unset($_SESSION['mensaje']);

switch ($opcion) {
    case "listar":
        //obtenemos la lista de productos:
        $listado = $notaModel->getNota();
        //y los guardamos en sesion:
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;
    case "crear":
        //navegamos a la pagina de creacion:
        header('Location: ../view/crear.php');
        break;
    case "guardar":
        // Obtenemos los valores ingresados por el usuario en el formulario:
        $cedula = $_REQUEST['cedula'];
        $nombres = $_REQUEST['nombres'];
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];

        // Creamos una nueva nota sin incluir el promedio, ya que se calcula en la base de datos:
        try {
            $notaModel->crearNota($cedula, $nombres, $nota1, $nota2);
        } catch (Exception $e) {
            // Colocamos el mensaje de la excepción en sesión
            $_SESSION['mensaje'] = $e->getMessage();
        }

        // Actualizamos la lista de notas para grabar en sesión:
        $listado = $notaModel->getNotas(true);
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        break;

    case "eliminar":
        // Obtenemos la cédula de la nota a eliminar:
        $cedula = $_REQUEST['cedula'];

        // Eliminamos la nota:
        $notaModel->eliminarNota($cedula);

        // Actualizamos la lista de notas para grabar en sesión:
        $listado = $notaModel->getNotas(true);
        $_SESSION['listado'] = serialize($listado);

        // Redirigimos al índice o lista de notas:
        header('Location: ../view/index.php');
        break;

    case "cargar":
        // Obtenemos los datos completos de la nota utilizando la cédula:
        $cedula = $_REQUEST['cedula'];
        $nota = $notaModel->getNota($cedula);

        // Guardamos la nota en sesión para posteriormente visualizarla
        // en un formulario para permitirle al usuario editar los valores:
        $_SESSION['nota'] = $nota;

        // Redirigimos al formulario de actualización de notas:
        header('Location: ../view/actualizar.php');
        break;

    case "actualizar":
        // Obtenemos los datos modificados por el usuario:
        $cedula = $_REQUEST['cedula'];
        $nombres = $_REQUEST['nombres'];
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];

        // El promedio se calcula en la base de datos, pero si fuera necesario
        // calcularlo aquí antes de enviarlo a la base de datos, se puede hacer así:
        // $promedio = ($nota1 + $nota2) / 2;

        // Actualizamos los datos de la nota en la base de datos:
        $notaModel->actualizarNota($cedula, $nombres, $nota1, $nota2);

        // Actualizamos la lista de notas (si es necesario) para grabar en sesión:
        $listado = $notaModel->getNotas(true);
        $_SESSION['listado'] = serialize($listado);

        // Redirigimos al índice o al listado de notas después de la actualización:
        header('Location: ../view/index.php');
        break;

    default:
        //si no existe la opcion recibida por el controlador, siempre
        //redirigimos la navegacion a la pagina index:
        header('Location: ../view/index.php');
}
