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
    <?php
    //recibir parametros:
    $peso = $_REQUEST['peso'];
    $estatura = $_REQUEST['estatura'];
    //calcular el imc:
    $imc = $peso / ($estatura * $estatura);
    //mostrar el resultado:
    ?>
    <h2>IMC</h2>
    <article>
        <h2>El resultado es:</h2>
        <p>
            <?php
            echo "$imc";
            ?>
        </p>
    </article>
    <img src="https://www.nutt.es/wp-content/uploads/2023/11/que-es-el-IMC-
tabla-valores-nutricionista-valencia.jpg" alt="">
</body>

</html>