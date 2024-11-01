@extends('layouts.app') 

@section('title', 'Editar Actividad')

@section('content')
    <h1>Editar Actividad</h1>

    <form action="{{ route('actividades.update', $actividad->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="form-group">
            <label for="nombre_actividad">Nombre de la Actividad:</label>
            <input type="text" name="nombre_actividad" value="{{ old('nombre_actividad', $actividad->nombre_actividad) }}" required>
        </div>

        <button type="submit">Guardar Cambios</button>
    </form>
@endsection