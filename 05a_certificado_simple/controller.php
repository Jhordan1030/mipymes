<?php
    //recibir datos del formulario:
    $cedula=$_REQUEST['cedula'];
    $nombres=$_REQUEST['nombres'];
    $nota1=$_REQUEST['nota1'];
    $nota2=$_REQUEST['nota2'];
    //llamada al modelo del sistema:
    include_once './CertificadoModel.php';
    $certificadoModel=new CertificadoModel();
    $mensaje = $certificadoModel->generarResultado($cedula,$nombres,$nota1,$nota2);

    //presentar resultados:
    header('Location: certificado.php?mensaje='.$mensaje);
?>