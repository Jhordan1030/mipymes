<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Libro</title>
</head>
<body>
    <h1>Actualizar Libro</h1>
    <form action="index.php?action=actualizar" method="post">
        <input type="hidden" name="codigo" value="<?= $libro['lib_codigo'] ?>">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?= $libro['lib_titulo'] ?>" required><br><br>
        <label for="año">Año:</label>
        <input type="number" id="año" name="año" value="<?= $libro['lib_año'] ?>" required><br><br>
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" value="<?= $libro['lib_autor'] ?>" required><br><br>
        <label for="paginas">Páginas:</label>
        <input type="number" id="paginas" name="paginas" value="<?= $libro['lib_paginas'] ?>" required><br><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
