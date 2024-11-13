<?php
    include_once "./ModelCarrito.php";
    //recibir parametros
    $nombreProducto=$_REQUEST['nombreProducto'];
    $cantidad=$_REQUEST['cantidad'];
    $precioUnitario=$_REQUEST['precioUnitario'];
    //procedemos a través del model
    $modelCarrito=new ModelCarrito();
    $modelCarrito->agregarProducto($nombreProducto,$precioUnitario,$cantidad);
    //redirigir navegacion
    header('Location: listado.php');
?>