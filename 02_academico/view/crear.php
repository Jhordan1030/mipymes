<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h3>Crear nuevo producto</h3>
    <form action="../controller/controller.php">
        <input type="hidden" value="guardar" name="opcion">
        <label>Cedula:</label>
        <input type="text" name="cedula" required>
        <label>Nombres:</label>
        <input type="text" name="nombres" required>
        <label>Nota1:</label>
        <input type="number" step="0.01" min="1" name="nota1">
        <label>Nota2:</label>
        <input type="number" step="0.01" min="1" name="nota2"><br>
        <input type="submit" value="Crear">
    </form>
</body>

</html>