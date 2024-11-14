<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Biblioteca</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h3>CRUD Libros</h3>

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
                <th>CEDULA</th>
                <th>NOMBRES</th>
                <th>NOTA1</th>
                <th>NOTA2</th>
                <th>PROMEDIO</th>
                <th>ELIMINAR</th>
                <th>ACTUALIZAR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            include_once '../model/Nota.php';
            //verificamos si existe en sesion el listado de productos:
            if (isset($_SESSION['listado'])) {
                $listado = unserialize($_SESSION['listado']);
                foreach ($listado as $not) {
                    echo "<tr>";
                    echo "<td>" . $lib->getCedula() . "</td>";
                    echo "<td>" . $lib->getNombres() . "</td>";
                    echo "<td>" . $lib->getNota1() . "</td>";
                    echo "<td>" . $lib->getNota2() . "</td>";
                    echo "<td>" . $lib->getPromedio() . "</td>";
                    //opciones para invocar al controlador indicando la opcion eliminar o cargar
                    //y la fila que selecciono el usuario (con el codigo del producto):
                    echo "<td><a href='../controller/controller.php?opcion=eliminar&lcedula=" . $lib->getCedula() . "'>eliminar</a></td>";
                    echo "<td><a href='../controller/controller.php?opcion=cargar&cedula=" . $lib->getCedula() . "'>actualizar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=6>No se han cargado datos.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>