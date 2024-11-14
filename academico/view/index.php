<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CRUD Notas</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h3>CRUD Notas</h3>
    <table>
        <tr>
            <td>
                <form action="../controller/controller.php">
                    <input type="hidden" name="opcion" value="listar">

                    <label>
                        <input type="radio" name="orden" value="asc" checked>
                        Orden Ascendente
                    </label>

                    <label>
                        <input type="radio" name="orden" value="desc" >
                        Orden Descendente
                    </label>

                    <input type="submit" value="Listar">
                </form>
            </td>
            <td>
                <form action="../controller/controller.php"><input type="hidden" name="opcion" value="crear"><input type="submit" value="Crear nota"></form>
            </td>
            <td>
                <form action="../controller/controller.php"><input type="hidden" name="opcion" value="promedio_general"><input type="submit" value="Calcular Promedio General"></form>
            </td>

        </tr>
        <tr>
            <td>
                <form action="../controller/controller.php" method="GET" onsubmit="return confirm('¿Estás seguro de que deseas restablecer todas las notas a 0?');">
                    <input type="hidden" name="opcion" value="resetear_notas">
                    <input type="submit" value="Restablecer todas las notas a 0">
                </form>
            </td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th>CÉDULA</th>
                <th>NOMBRES</th>
                <th>NOTA 1</th>
                <th>NOTA 2</th>
                <th>PROMEDIO</th>
                <th>ELIMINAR</th>
                <th>ACTUALIZAR</th>
            </tr>
        </thead>
        <tbody>
            <?php
            session_start();
            include_once '../model/Nota.php';
            if (isset($_SESSION['listado'])) {
                $listado = unserialize($_SESSION['listado']);
                foreach ($listado as $nota) {
                    echo "<tr>";
                    echo "<td>" . $nota->getCedula() . "</td>";
                    echo "<td>" . $nota->getNombres() . "</td>";
                    echo "<td>" . $nota->getNota1() . "</td>";
                    echo "<td>" . $nota->getNota2() . "</td>";
                    echo "<td>" . $nota->getPromedio() . "</td>";
                    echo "<td><a href='../controller/controller.php?opcion=eliminar&cedula=" . $nota->getCedula() . "'>eliminar</a></td>";
                    echo "<td><a href='../controller/controller.php?opcion=cargar&cedula=" . $nota->getCedula() . "'>actualizar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No hay datos disponibles.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    if (isset($_SESSION['promedio_general'])) {
        echo "<p>Promedio general de todos los alumnos: " . $_SESSION['promedio_general'] . "</p>";
        unset($_SESSION['promedio_general']); 
    }
    ?>


</body>

</html>