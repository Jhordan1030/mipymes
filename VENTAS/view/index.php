<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Productos</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h3>CRUD productos</h3>
    <table>
        <tr>
            <td>
                <form action="../controller/controller.php">
                    <input type="hidden" value="listar" name="opcion">
                    <input type="submit" value="Consultar listado">
                </form>
            </td>
            <td>
                <form action="../controller/controller.php">
                    <input type="hidden" value="crear" name="opcion">
                    <input type="submit" value="Crear producto">
                </form>
            </td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th>CODIGO</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th>ELIMINAR</th>
                <th>ACTUALIZAR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            include_once '../model/Producto.php';
            //verificamos si existe en sesion el listado de productos:
            if (isset($_SESSION['listado'])) {
                $listado = unserialize($_SESSION['listado']);
                foreach ($listado as $prod) {
                    echo "<tr>";
                    echo "<td>" . $prod->getCodigo() . "</td>";
                    echo "<td>" . $prod->getNombre() . "</td>";
                    echo "<td>" . $prod->getPrecio() . "</td>";
                    echo "<td>" . $prod->getCantidad() . "</td>";
                    //opciones para invocar al controlador indicando la opcion eliminar o cargar
                    //y la fila que selecciono el usuario (con el codigo del producto):
                    echo "<td><a href='../controller/controller.php?opcion=eliminar&codigo=" . $prod->getCodigo() . "'>eliminar</a></td>";
                    echo "<td><a href='../controller/controller.php?opcion=cargar&codigo=" . $prod->getCodigo() . "'>actualizar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=6>No se han cargado datos.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    if(isset($_SESSION['valorTotal'])){
        echo "<h4>Valor total de productos: ".$_SESSION['valorTotal']."</h4>";
    }
?>
</body>

</html>