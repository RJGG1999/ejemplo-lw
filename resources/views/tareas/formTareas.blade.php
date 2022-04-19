<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario</title>
</head>
<body>
    <h1>Agregar Tarea</h1>

    {{-- Forma floja :v/global --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    @endif

    @isset($tarea)
        <form action="/tarea/{{ $tarea->id }}" method="POST"> {{-- Editar tarea --}}
        @method('PATCH')
    @else
        <form action="/tarea" method="POST"> {{-- Crear tarea --}}
    @endisset

        @csrf
        <label for="tarea">Nombre de la tarea:</label><br>
        <input type="text" name="tarea" value="{{ isset($tarea) ? $tarea->tarea : '' }}{{ old('tarea') }}"><br><br>
        {{-- Específica para cada campo --}}
        @error('tarea')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" id="descripcion" cols="10" rows="5">
            {{ isset($tarea) ? $tarea->descripcion : '' }}{{ old('descripcion') }}
        </textarea><br><br>
        <label for="tipo">Tipo:</label><br>
        <select name="tipo" id="tipo">
            <option value="Escuela" {{ isset($tarea) && $tarea->tipo == 'Escuela' ? 'selected' : '' }}>Escuela</option>
            <option value="Trabajo" {{ isset($tarea) && $tarea->tipo == 'Trabajo' ? 'selected' : '' }}>Trabajo</option>
            <option value="Otra" {{ isset($tarea) && $tarea->tipo == 'Otra' ? 'selected' : '' }}>Otra</option>
        </select>
        <br><br>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
