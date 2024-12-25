<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importadora Anturios</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #007bff;
            color: white;
            margin-bottom: 0;
        }

        .navbar a {
            color: white !important;
        }

        .sidebar {
            background-color: #2c3e50;
            height: 100vh;
            padding: 20px;
            color: white;
            position: fixed;
            top: 50px;
        }

        .sidebar h5 {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            padding: 5px 10px;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .sidebar a:hover {
            background-color: #34495e;
            padding-left: 15px;
        }

        .card {
            border: none;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
            background-color: white;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }

        .footer img {
            height: 50px;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/home">Registro de la Importadora Anturios.</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><i class="fas fa-user"></i> nobody</a></li>
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="col-sm-2 sidebar">
        <h5>Módulo Registo</h5>
        <a class="nav-link" href="/home">Home</a>
        <a class="nav-link" href="/parametro">Parametros: CRUD - Marcelo Chiriboga</a>
        <a class="nav-link" href="/tipo_empaque">Tipo de Empaque: CRUD - Marcelo Chiriboga</a>
        <a class="nav-link" href="/tipoidentificacion">Tipo de Identificación: CRUD - Giuliana Espinoza</a>
        <a class="nav-link" href="/tipocliente">Tipo de Cliente: CRUD - Giuliana Espinoza</a>
        <a class="nav-link" href="/canton">Canton: CRUD - Deysi Guevara</a>
        <a class="nav-link" href="/provincia">Provincia: CRUD - Deysi Guevara</a>
        <a class="nav-link" href="/cargo">Cargo: CRUD - Deysi Guevara</a>
        <a class="nav-link" href="/empleado">Empleado: CRUD - Deysi Guevara</a>
        <a class="nav-link" href="/pais">Pais: CRUD - Jhordan Huera</a>
        <a class="nav-link" href="/proveedor">Proveedor: CRUD - Jhordan Huera</a>
        <a class="nav-link" href="/tpago">Tipo de Pago: CRUD - Jhordan Huera</a>
        
    </div>

    <!-- Main Content -->
    <div class="col-sm-10 col-sm-offset-2" style="padding-top: 70px;">

        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</body>

</html>
