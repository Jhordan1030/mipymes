<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Libro</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h3>Actualizar libro</h3>
    <?php
    include_once '../model/Libro.php';
    //obtenemos los datos de sesion:
    session_start();
    $libro = $_SESSION['libro'];
    ?>
    <form action="../controller/controller.php">
        <input type="hidden" value="actualizar" name="opcion">
        <!-- Utilizamos pequeños scripts PHP para obtener los valores del producto: -->
        <input type="hidden" value="<?php echo $libro->getLib_codigo(); ?>" name="lib_codigo">
        
        <label>Codigo:</label>
        <b><?php echo $libro->getLib_codigo(); ?></b>

        <label>Titulo:</label>
        <input type="text" name="lib_titulo" required value="<?php echo $libro->getLib_titulo(); ?>">
        
        <label>Año:</label>
        <input type="number"  name="lib_año" value="<?php echo $libro->getLib_año(); ?>">

        <label>Autor:</label>
        <input type="text"  name="lib_autor" value="<?php echo $libro->getLib_autor(); ?>">

        <label>Página:</label>
        <input type="number" min="1" name="lib_paginas" value="<?php echo $libro->getLib_paginas(); ?>"><br>
        
        <input type="submit" value="Actualizar">
    </form>
</body>

</html>