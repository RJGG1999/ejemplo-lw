</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>
</head>
<body>
    <h1>Información de tarea</h1>
    <h3>Usuario {{ $tarea->user->name }}</h3>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tarea</th>
            <th>Descripcion</th>
            <th>Tipo</th>
            <th>Prioridad</th>
        </tr>
        <tr>
            <td>{{ $tarea->id }}</td>
            <td>{{ $tarea->tarea }}</td>
            <td>{{ $tarea->descripcion }}</td>
            <td>{{ $tarea->tipo }}</td>
            <td>
                @foreach ($tarea->etiquetas as $etiqueta)
                    {{ $etiqueta->etiqueta }} <br>
                @endforeach
            </td>
        </tr>
    </table>
</body>
</html>

