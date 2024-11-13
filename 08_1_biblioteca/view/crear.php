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
    <h3>Crear nuevo libro</h3>
    <form action="../controller/controller.php">
        <input type="hidden" value="guardar" name="opcion">
        
        <label>Codigo:</label>
        <input type="number" name="lib_codigo" required>
        
        <label>Titulo:</label>
        <input type="text" name="lib_titulo" required>
        
        <label>Año:</label>
        <input type="number"   name="lib_año" require>
        
        <label>Autor:</label>
        <input type="text"  name="lib_autor">
        
        <label>Páginas</label>
        <input type="number" min="1" name="lib_paginas"><br>
        <input type="submit" value="Crear">
    </form>
</body>

</html>