<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nota</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body>

<?php
session_start();
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); 
}
?>

    <h3>Crear nueva nota</h3>
    <form action="../controller/controller.php" method="GET">
        <input type="hidden" value="guardar" name="opcion">

        <label>Cédula:</label>
        <input type="text" name="cedula" required>

        <label>Nombres:</label>
        <input type="text" name="nombres" required>

        <label>Nota 1:</label>
        <input type="number" name="nota1" min="0" max="10" required>

        <label>Nota 2:</label>
        <input type="number" name="nota2" min="0" max="10" required>

        <br>
        <input type="submit" value="Guardar">
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
