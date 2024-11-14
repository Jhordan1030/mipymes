<?php
require_once '../model/NotaModel.php';
session_start();
$notaModel = new NotaModel();
$opcion = $_REQUEST['opcion'];

switch ($opcion) {
    case "crear":
        header('Location: ../view/crear.php');
        break;
    case "eliminar":
        $cedula = $_REQUEST['cedula'];
        $notaModel->eliminarNota($cedula);
        header('Location: ../view/index.php');
        break;
    case "cargar":
        $cedula = $_REQUEST['cedula'];
        $nota = $notaModel->getNota($cedula);
        $_SESSION['nota'] = $nota;
        header('Location: ../view/actualizar.php');
        break;
    case "actualizar":
        $cedula = $_REQUEST['cedula'];
        $nombres = $_REQUEST['nombres'];
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];
        $notaModel->actualizarNota($cedula, $nombres, $nota1, $nota2);
        header('Location: ../view/index.php');
        break;
    case "guardar":
        $cedula = $_REQUEST['cedula'];
        $nombres = $_REQUEST['nombres'];
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];

        if ($notaModel->existeCedula($cedula)) {
            $_SESSION['error'] = "La cédula ya existe. No se puede crear un nuevo registro con la misma cédula.";
            header('Location: ../view/crear.php');
            exit;
        } else {
            $notaModel->crearNota($cedula, $nombres, $nota1, $nota2);
            header('Location: ../view/index.php');
            exit;
        }
        break;

    case "promedio_general":
        $promedio_general = $notaModel->calcularPromedioGeneral();
        $_SESSION['promedio_general'] = $promedio_general;
        header('Location: ../view/index.php');
        break;
    case "resetear_notas":
        $notaModel->resetearNotas();
        header('Location: ../view/index.php');
        exit;
    case "listar":
        $orden = $_REQUEST['orden'];
        if ($orden == 'desc') {
            $listado = $notaModel->getNotasDesc();
        } else {
            $listado = $notaModel->getNotas();
        }
        $_SESSION['listado'] = serialize($listado);
        header('Location: ../view/index.php');
        exit;
    default:
        header('Location: ../view/index.php');
}
