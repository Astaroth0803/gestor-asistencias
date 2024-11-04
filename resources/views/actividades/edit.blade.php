@extends('layouts.app') 

@section('title', 'Editar Actividad')

@section('content')
    <h1 class="title">Editar Actividad</h1>

    <form action="{{ route('actividades.update', $actividad->id) }}" method="POST">
        @csrf
        @method('PUT') 

        <div class="field">
            <label class="label" for="nombre_actividad">Nombre de la Actividad:</label>
            <div class="control">
                <input class="input" type="text" name="nombre_actividad" value="{{ old('nombre_actividad', $actividad->nombre_actividad) }}" required>
            </div>
        </div>

        <div class="control">
            <button type="submit" class="button is-primary">Guardar Cambios</button>
        </div>
    </form>
@endsection
