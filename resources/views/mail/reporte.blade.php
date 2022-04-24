<h1>Reporte de tareas</h1>

<ul>
    @foreach ($tareas as $tarea)
        <li>{{ $tarea->tarea }}</li>
    @endforeach
</ul>
