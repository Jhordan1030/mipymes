<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMC</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>

<body>
    <h2>Calculadora de IMC</h2>
    <form action="calcular.php">
        <table>
            <tbody>
                <tr>
                    <td>Ingrese su peso en kg</td>
                    <td><input type="number" name="peso"></td>
                </tr>
                <tr>
                    <td>Ingrese su estatura en m</td>
                    <td><input type="number" name="estatura" step="0.01"></td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="Calcular">
    </form>
</body>

</html>