<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Aplicación de Gestión de Inventario')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('LogoEmpresa.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            padding-top: 70px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @if (!isset($hideNavbar) || !$hideNavbar)
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Gestión de Inventario</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Productos -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('producto.index') }}">Productos</a>
                    </li>

                    <!-- Empleados -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('empleado.index') }}">Empleados</a>
                    </li>

                    <!-- Bodegas (Desplegable) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBodegas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bodegas
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownBodegas">
                            <li><a class="dropdown-item" href="{{ route('bodega.index') }}">Listado de Bodegas</a></li>
                            <li><a class="dropdown-item" href="{{ route('bodega.create') }}">Añadir Nueva Bodega</a></li>
                        </ul>
                    </li>

                    <!-- Transacción Producto (Desplegable) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTransaccion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Transacción Producto
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownTransaccion">
                            <li><a class="dropdown-item" href="{{ route('transaccion_producto.index') }}">Registrar Transacción</a></li>
                            <li><a class="dropdown-item" href="#">Historial de Transacciones</a></li>
                        </ul>
                    </li>

                    <!-- Tipo Nota -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tipoNota.index') }}">Tipo Nota</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif

    <!-- Content -->
    <div class="container">
        @yield('content')
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
