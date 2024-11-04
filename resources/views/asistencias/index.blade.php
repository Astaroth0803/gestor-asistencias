@extends('layouts.app')

@section('title', 'Listado de Asistencias')

@section('content')
    <h1 class="title">Listado de Asistencias</h1>

    @if(session('success'))
        <p class="notification is-success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('asistencias.index') }}" method="GET"> 
        <div class="columns is-multiline"> 
            <div class="column is-one-quarter">
                <div class="field">
                    <label class="label" for="filtro">Filtrar por:</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="filtro" onchange="this.form.submit()"> 
                                <option value="">Selecciona un filtro</option>
                                <option value="semana" {{ request('filtro') == 'semana' ? 'selected' : '' }}>Esta Semana</option>
                                <option value="mes" {{ request('filtro') == 'mes' ? 'selected' : '' }}>Este Mes</option>
                                <option value="anio" {{ request('filtro') == 'anio' ? 'selected' : '' }}>Este Año</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-one-quarter">
                <div class="field">
                    <label class="label" for="fecha_inicio">Fecha de inicio:</label>
                    <div class="control">
                        <input type="date" class="input" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
                    </div>
                </div>
            </div>
            <div class="column is-one-quarter">
                <div class="field">
                    <label class="label" for="fecha_fin">Fecha de fin:</label>
                    <div class="control">
                        <input type="date" class="input" name="fecha_fin" value="{{ request('fecha_fin') }}">
                    </div>
                </div>
            </div>
            <div class="column is-one-quarter">
                <div class="field">
                    <label class="label" for="per_page">Filas por página:</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="per_page" onchange="this.form.submit()">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <table class="table is-bordered" style="text-align: left">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>Sector</th>
                <th>Actividad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->nombre }} {{ $asistencia->apellido }}</td>
                    <td>{{ $asistencia->edad }}</td>
                    <td>{{ $asistencia->sexo }}</td>
                    <td>{{ $asistencia->sector }}</td>
                    <td>{{ $asistencia->actividad->nombre_actividad }}</td>
                    <td>{{ $asistencia->fecha_asistencia->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <nav class="buttons">
        <a class="button" href="{{ route('asistencias.create') }}">Nueva asistencia</a>
        <a class="button" href="{{ route('asistencias.estadisticas') }}">Ver estadísticas de las asistencias</a>
    </nav>

    <div class="pagination">
        <nav class="pagination is-centered" role="navigation" aria-label="pagination"> 
            @if ($asistencias->previousPageUrl())
                <a class="pagination-previous" href="{{ $asistencias->previousPageUrl() }}">&laquo;</a>
            @else
                <a class="pagination-previous" disabled>&laquo;</a>
            @endif
            
            @if ($asistencias->nextPageUrl())
                <a class="pagination-next" href="{{ $asistencias->nextPageUrl() }}">&raquo;</a>
            @else
                <a class="pagination-next" disabled>&raquo;</a>
            @endif
            
            <ul class="pagination-list">
                @for ($i = 1; $i <= $asistencias->lastPage(); $i++)
                    <li>
                        <a href="{{ $asistencias->url($i) }}" class="pagination-link {{ ($asistencias->currentPage() == $i) ? 'is-current' : '' }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
    </div>

@endsection
