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
    <h1>Listado de tareas</h1>

    <a href="/tarea/create/">Agregar nueva tarea</a><br><br>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Tarea</th>
            <th>Descripcion</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
        @foreach($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->user->name }}</td>
                <td>{{ $tarea->tarea }}</td>
                <td>{{ $tarea->descripcion }}</td>
                <td>{{ $tarea->tipo }}</td>
                <td>
                    <a href="tarea/{{ $tarea->id }}">Ver detalles</a>
                    <a href="tarea/{{ $tarea->id }}/edit">Editar</a>
                    <form action="/tarea/{{ $tarea->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Borrar">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
