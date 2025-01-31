<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota PDF</title>
    <style>
body { font-family: Arial, sans-serif; }
        .container { width: 100%; margin: 0 auto; }
        .title { text-align: center; font-size: 24px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="title">Nota: {{ $nota->codigo }}</h2>
<p><strong>Tipo:</strong> {{ $nota->tiponota }}</p>
<p><strong>Solicitante:</strong> {{ $nota->responsableEmpleado->nombreemp ?? 'N/A' }}</p>
<p><strong>Bodega:</strong> {{ $nota->bodega->nombrebodega ?? 'N/A' }}</p>
<p><strong>Fecha:</strong> {{ $nota->fechanota }}</p>
<p><strong>Estado:</strong> {{ $nota->transaccionProducto->estado ?? 'Sin Confirmar' }}</p>

<h3>Productos</h3>
<table>
    <thead>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Tipo de Empaque</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($nota->detalles as $detalle)
        <tr>
            <td>{{ $detalle->producto->nombre ?? 'N/A' }}</td>
            <td>{{ $detalle->cantidad }}</td>
            <td>{{ $detalle->tipoEmpaque->nombretipoempaque ?? 'Sin Empaque' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
</body>
</html>
