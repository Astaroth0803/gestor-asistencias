@extends('layouts.app')

@section('title', 'Crear Actividad')

@section('content')
    <h1>Crear Actividad</h1>

    @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form action="{{ route('actividades.store') }}" method="POST" class="actividad-form">
        @csrf
        <div class="form-group">
            <label for="nombre_actividad">Nombre de la Actividad:</label>
            <input type="text" id="nombre_actividad" name="nombre_actividad" required>
        </div>
        <button type="submit" class="button button is-dange">Crear Actividad</button>
    </form>
@endsection
