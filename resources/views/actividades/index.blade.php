@extends('layouts.app')

@section('title', 'Actividades')

@section('content')
    <h1>Listado de Actividades</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <table class="table is-fullwidthd"> 
        <thead>
            <tr>
                <th>Nombre de la Actividad</th> 
                <th>Acciones</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($actividades as $actividad)
                <tr style="text-align: left">
                    <td>{{ $actividad->nombre_actividad }}</td> 
                    <td>
                        <a href="{{ route('actividades.edit', $actividad->id) }}" class="button is-dark">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('actividades.create') }}" class="button is-success">Crear nueva actividad</a>
@endsection