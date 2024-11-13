<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Libro</title>
</head>
<body>
    <h1>Agregar Nuevo Libro</h1>
    <form action="index.php?action=crear" method="post">
        <label for="codigo">Código:</label>
        <input type="number" id="codigo" name="codigo" required><br><br>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>
        <label for="año">Año:</label>
        <input type="number" id="año" name="año" required><br><br>
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required><br><br>
        <label for="paginas">Páginas:</label>
        <input type="number" id="paginas" name="paginas" required><br><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
