<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h2>Carrito de compras</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once "./ModelCarrito.php";
            $modelCarrito = new ModelCarrito();
            $carrito = $modelCarrito->obtenerProductos();
            foreach ($carrito as $p) {
                echo "<tr>";
                echo "<td>" . $p->getNombreProducto() . "</td>";
                echo "<td>" . $p->getCantidad() . "</td>";
                echo "<td>" . $p->getPrecioUnitario() . "</td>";
                echo "<td>" . $p->getSubtotal() . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php">Ir a inicio...</a>
</body>

</html>