<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Nota</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h3>Actualizar nota</h3>
    <?php
    include_once '../model/Nota.php';
    //obtenemos los datos de sesion:
    session_start();
    $nota = $_SESSION['nota'];
    ?>
    <form action="../controller/controller.php">
        <input type="hidden" value="actualizar" name="opcion">
        <!-- Utilizamos pequeños scripts PHP para obtener los valores del producto: -->
        <input type="hidden" value="<?php echo $libro->getCedula(); ?>" name="cedula">
        
        <label>Nombres:</label>
        <b><?php echo $nota->getCedula(); ?></b>

        <label>Nota1:</label>
        <input type="number" step="0.01" min="1" name="nota1" value="<?php echo $nota->getNota1(); ?>">
        
        <label>Nota2:</label>
        <input type="number" step="0.01" min="1" name="nota2" value="<?php echo $nota->getNota2(); ?>">
        
        <label>Promedio:</label>
        <input type="hidden" value="<?php echo $nota->getPromedio(); ?>" name="promedio">
        
        <input type="submit" value="Actualizar">
    </form>
</body>

</html>