<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro productos</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h2>Carrito de compras</h2>
    <h3>Registro de productos</h3>
    <form action="controller.php">
        <label>Producto:</label>
        <input type="text" name="nombreProducto" require>

        <label>Cantidad:</label>
        <input type="number" name="cantidad" require>

        <label>Precio Unitario:</label>
        <input type="number" step="0.01" name="precioUnitario" require>

        <label>Ingrese los datos y registre el producto en el carrito de compras</label>
        <input type="submit" name="Registrar producto" require>
    </form>
    <a href="listado.php">Ir al carrito...</a>
</body>

</html>