@extends('layouts.app')

@section('title', 'Actividades')

@section('content')
    <h1 class="title">Listado de Actividades</h1>

    @if(session('success'))
        <div class="notification is-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table is-bordered" style="text-align: left">
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
                        <a href="{{ route('actividades.edit', $actividad->id) }}" class="button is-dark is-small">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('actividades.create') }}" class="button">Crear nueva actividad</a>
@endsection
