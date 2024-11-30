<!DOCTYPE html> 
<html lang="es">

<head>
    <title>@yield('title','Home')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/parametro">Parametros: CRUD - Marcelo Chiriboga</a></li>
                    <li class="nav-item"><a class="nav-link" href="/pais">Pais: CRUD - Jhordan Huera</a></li>
                    <li class="nav-item"><a class="nav-link" href="/provincia">Provincia: CRUD - Deysi Guevara</a></li>
                    <li class="nav-item"><a class="nav-link" href="/canton">Canton: CRUD - Deysi Guevara</a></li>
                    <li class="nav-item"><a class="nav-link" href="/cargo">Cargo: CRUD - Deysi Guevara</a></li>
                    <li class="nav-item"><a class="nav-link" href="/empleado">Empleado: CRUD - Deysi Guevara</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tipo_empaque">Tipo de Empaque: CRUD - Marcelo Chiriboga</a></li>
                    <li class="nav-item"><a class="nav-link" href="/proveedor">Proveedor: CRUD - Jhordan Huera</a></li>
                    <li class="nav-item"><a class="nav-link" href="/tpago">Tipo de Pago: CRUD - Jhordan Huera</a></li>
                </ul>
            </div>
        </nav>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>
