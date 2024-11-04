@extends('layouts.app')

@section('title', 'Registrar Asistencia')

@section('content')
    <h1 class="title">Registrar Nueva Asistencia</h1>

    <form action="{{ route('asistencias.store') }}" method="POST" class="box">
        @csrf
        <div class="columns">
            <div class="column is-half">
                <div class="field">
                    <label class="label" for="nombre">Nombre</label>
                    <div class="control">
                        <input placeholder="Escriba su nombre" type="text" class="input" name="nombre" value="{{ old('nombre') }}" required>
                    </div>
                </div>
            </div>
            <div class="column is-half">
                <div class="field">
                    <label class="label" for="apellido">Apellido</label>
                    <div class="control">
                        <input placeholder="Escriba su apellido" type="text" class="input" name="apellido" value="{{ old('apellido') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="columns">
            <div class="column is-one-third">
                <div class="field">
                    <label class="label" for="edad">Edad</label>
                    <div class="control">
                        <input placeholder="Digite su edad" type="number" class="input" name="edad" value="{{ old('edad') }}" required>
                    </div>
                </div>
            </div>
            <div class="column is-one-third">
                <div class="field">
                    <label class="label" for="sexo">Sexo</label>
                    <div class="control">
                        <div class="select is-fullwidth">
                            <select name="sexo" required>
                                <option value="">Seleccione</option>
                                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-one-third">
                <div class="field">
                    <label class="label" for="sector">Sector</label>
                    <div class="control">
                        <input placeholder="Escriba su sector" type="text" class="input" name="sector" value="{{ old('sector') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label" for="actividad_id">Actividad</label>
            <div class="control">
                <div class="select is-fullwidth">
                    <select name="actividad_id" required>
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

        <div class="field">
            <div class="control">
                <button type="submit" class="button">Registrar</button>
                <a class="button" href="{{ route('asistencias.index') }}">Regresar</a>
            </div>
       
        </div>
    </form>

    @if($errors->any())
        <div class="notification is-danger">
            <h4 class="title is-4">Errores:</h4>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
