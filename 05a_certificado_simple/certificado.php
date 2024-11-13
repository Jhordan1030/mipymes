<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body>
    <div >
        <h1 >CERTIFICADO</h1>
        <p >Universidad Técnica del Norte</p>
        <h3>
            <?php
                $mensaje=$_REQUEST['mensaje'];
                echo $mensaje;
            ?>
        </h3>
        <hr >
        <p>2024 (c)</p>
    </div>
</body>
</html>
