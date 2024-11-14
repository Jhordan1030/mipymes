<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h3>Actualizar producto</h3>
    <?php
    include_once '../model/Producto.php';
    //obtenemos los datos de sesion:
    session_start();
    $producto = $_SESSION['producto'];
    ?>
    <form action="../controller/controller.php">
        <input type="hidden" value="actualizar" name="opcion">
        <!-- Utilizamos pequeños scripts PHP para obtener los valores del producto: -->
        <input type="hidden" value="<?php echo $producto->getCodigo(); ?>" name="codigo">
        <label>Codigo:</label>
        <b><?php echo $producto->getCodigo(); ?></b>
        <label>Nombre:</label>
        <input type="text" name="nombre" required value="<?php echo $producto->getNombre(); ?>">
        <label>Precio:</label>
        <input type="number" step="0.01" min="1" name="precio" value="<?php echo $producto->getPrecio(); ?>">
        <label>Cantidad:</label>
        <input type="number" min="1" name="cantidad" value="<?php echo $producto->getCantidad(); ?>"><br>
        <input type="submit" value="Actualizar">
    </form>
</body>

</html>