@extends('layouts.app')

@section('title', 'Actividades')

@section('content')
    <h1>Listado de Actividades</h1>
    <a href="{{ route('actividades.create') }}" class="btn-action" style="color: green">Crear nueva actividad</a>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <table class="table table-striped"> 
        <thead>
            <tr>
                <th>Nombre de la Actividad</th> 
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($actividades as $actividad)
                <tr>
                    <td>{{ $actividad->nombre_actividad }}</td> 
                    <td>
                        <a href="{{ route('actividades.edit', $actividad->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection