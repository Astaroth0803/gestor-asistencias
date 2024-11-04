@extends('layouts.app')

@section('title', 'Crear Actividad')

@section('content')
    <h1 class="title">Crear Actividad</h1>

    @if (session('success'))
        <div class="notification is-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('actividades.store') }}" method="POST" class="actividad-form">
        @csrf
        <div class="field">
            <label class="label" for="nombre_actividad">Nombre de la Actividad:</label>
            <div class="control">
                <input class="input" type="text" id="nombre_actividad" name="nombre_actividad" required>
            </div>
        </div>
        
        <div class="control">
            <button type="submit" class="button">Crear Actividad</button>
        </div>
    </form>
@endsection
