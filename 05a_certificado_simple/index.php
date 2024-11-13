<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generación certificado</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
</head>
<body>
   
        
            <h1>Registro de usuarios</h1>
        
    <p>Por favor registre los siguientes datos</p>
    <hr>
    <p>Con estos datos se generará el certificado</p>
    <form action="controller.php">
        <div>
            <label for="">Ingrese la cédula</label>
            <input required type="text" name="cedula" id="cedula" placeholder="Sólo números" aria-describedby="helpId">
            <small id="helpId">Obligatorio</small>
        </div>
        <div >
            <label for="">Nombre y apellido</label>
            <input type="text" name="nombres" id="nombre" aria-describedby="helpId">
            <small id="helpId">Sus nombres</small>
        </div>
        <div >
            <label for="">Nota 1</label>
            <input type="number" name="nota1" id="nota1" aria-describedby="helpId">
            <small id="helpId" >Texto de ayuda</small>
        </div>
        <div >
            <label for="">Nota 2</label>
            <input type="number" name="nota2" id="nota2" aria-describedby="helpId">
            <small id="helpId" >Texto de ayuda</small>
        </div>
        <p class="lead">
            <input type="submit" value="Registrar">
        </p>
    </form>
    </div>  
</body>
</html>