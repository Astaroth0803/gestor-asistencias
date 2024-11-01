@extends('layouts.app')

@section('title', 'Registrar Asistencia')

@section('content')
    <div class="container"> 
        <h1>Registrar Nueva Asistencia</h1>

        <form action="{{ route('asistencias.store') }}" method="POST" class="asistencia-form">
            @csrf
            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" class="form-control" name="edad" value="{{ old('edad') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select class="form-control" name="sexo" required>
                            <option value="">Seleccione</option>
                            <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="sector">Sector:</label>
                        <input type="text" class="form-control" name="sector" value="{{ old('sector') }}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"> 
                    <div class="form-group">
                        <label for="actividad_id">Actividad:</label>
                        <select class="form-control" name="actividad_id" required>
                            <option value="">Seleccione una actividad</option>
                            @foreach($actividades as $actividad)
                                <option value="{{ $actividad->id }}" {{ old('actividad_id') == $actividad->id ? 'selected' : '' }}>
                                    {{ $actividad->nombre_actividad }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-submit">Registrar</button>
        </form>
        @if($errors->any())
            <div class="error-messages">
                <h4>Errores:</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div> 
@endsection