@component('mail::message')
# Tareas

@component('mail::table')
|    Tareas     |
| ------------- |
@foreach ($tareas as $t)
| {{ $t->tarea }} | Centered      | $10      |
@endforeach
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
