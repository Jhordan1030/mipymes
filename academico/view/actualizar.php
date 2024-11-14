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
    session_start();
    if (isset($_SESSION['nota'])) {
        $nota = $_SESSION['nota'];
    ?>
    <form action="../controller/controller.php">
        <input type="hidden" value="actualizar" name="opcion">
        <input type="hidden" name="cedula" value="<?php echo $nota->getCedula(); ?>">

        <label>Cédula:</label>
        <b><?php echo $nota->getCedula(); ?></b>

        <label>Nombres:</label>
        <input type="text" name="nombres" required value="<?php echo $nota->getNombres(); ?>">

        <label>Nota 1:</label>
        <input type="number" name="nota1" min="0" max="10" required value="<?php echo $nota->getNota1(); ?>">

        <label>Nota 2:</label>
        <input type="number" name="nota2" min="0" max="10" required value="<?php echo $nota->getNota2(); ?>">

        <br>
        <input type="submit" value="Actualizar">
        <a href="index.php">Cancelar</a>
    </form>
    <?php
    } else {
        echo "<p>Error: No se encontró la información de la nota.</p>";
        echo "<a href='index.php'>Volver a la página principal</a>";
    }
    ?>
</body>
</html>
