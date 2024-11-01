@extends('layouts.app')

@section('title', 'Listado de Asistencias')

@section('content')
    <h1>Listado de Asistencias</h1>

    @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <form action="{{ route('asistencias.index') }}" method="GET"> 
        <div class="form-row"> 
            <div class="form-group col-md-3">
                <label for="filtro">Filtrar por:</label>
                <select name="filtro" class="form-control" onchange="this.form.submit()"> 
                    <option value="">Selecciona un filtro</option>
                    <option value="semana" {{ request('filtro') == 'semana' ? 'selected' : '' }}>Esta Semana</option>
                    <option value="mes" {{ request('filtro') == 'mes' ? 'selected' : '' }}>Este Mes</option>
                    <option value="anio" {{ request('filtro') == 'anio' ? 'selected' : '' }}>Este Año</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="fecha_inicio">Fecha de inicio:</label>
                <input type="date" class="form-control" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="fecha_fin">Fecha de fin:</label>
                <input type="date" class="form-control" name="fecha_fin" value="{{ request('fecha_fin') }}">
            </div>
            <div class="form-group col-md-3">
                <label for="per_page">Filas por página:</label>
                <select name="per_page" class="form-control" onchange="this.form.submit()">
                    <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar por Fecha</button> 
    </form>


    <table class="asistencias-table">
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

    <nav class="actions">
        <button id="btn-reg-asis" ><a href="{{ route('asistencias.create') }}" >
            Nueva asistencia<a></button>

            <button id="btn-ver-stats"><a href="{{ route('asistencias.estadisticas') }}">
                Ver estadísticas de las asistencias<a></button>
    </nav>

    <div class="pagination-links">
        <nav aria-label="Page navigation example"> 
            <ul class="pagination">
                <li class="page-item {{ $asistencias->previousPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $asistencias->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $asistencias->lastPage(); $i++)
                    <li class="page-item {{ ($asistencias->currentPage() == $i) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $asistencias->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $asistencias->nextPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $asistencias->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    
    
@endsection