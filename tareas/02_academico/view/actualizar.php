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
    <h3>Actualizar Nota</h3>
    <?php
    include_once '../model/Nota.php';
    // Obtenemos los datos de sesión:
    session_start();
    $nota = $_SESSION['nota'];
    ?>
    <form action="../controller/controller.php" method="POST">
        <input type="hidden" value="actualizar" name="opcion">
        <!-- Utilizamos pequeños scripts PHP para obtener los valores de la nota: -->
        <input type="hidden" value="<?php echo $nota->getCedula(); ?>" name="cedula">

        <label>Cédula:</label>
        <b><?php echo $nota->getCedula(); ?></b>

        <label>Nombres:</label>
        <input type="text" name="nombres" required value="<?php echo $nota->getNombres(); ?>">

        <label>Nota 1:</label>
        <input type="number" name="nota1" min="0" max="10" step="0.1" required value="<?php echo $nota->getNota1(); ?>">

        <label>Nota 2:</label>
        <input type="number" name="nota2" min="0" max="10" step="0.1" required value="<?php echo $nota->getNota2(); ?>">

        <label>Promedio:</label>
        <input type="number" name="promedio" min="0" max="10" step="0.1" readonly value="<?php echo $nota->getPromedio(); ?>"><br>

        <input type="submit" value="Actualizar Nota">
    </form>
</body>

</html>