<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{

    // Método para mostrar el formulario de creación de actividad
    public function create()
    {
        return view('actividades.create'); // Asegúrate de que la vista existe
    }

    // Método para almacenar la actividad en la base de datos
    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'nombre_actividad' => 'required|string|max:255',
        ]);

        // Crear una nueva actividad
        Actividad::create($request->all());

        return redirect()->route('actividades.index')->with('success', 'Actividad creada exitosamente.');
    }

    // Método para listar las actividades
    public function index()
    {
        $actividades = Actividad::all(); // Obtener todas las actividades
        return view('actividades.index', compact('actividades')); // Asegúrate de que la vista existe
    }
    public function edit(Actividad $actividad)
    {
        return view('actividades.edit', compact('actividad')); // Asegúrate de que la vista existe
    }

    // Método para actualizar una actividad en la base de datos
    public function update(Request $request, Actividad $actividad)
    {
        // Validar la entrada
        $request->validate([
            'nombre_actividad' => 'required|string|max:255',
        ]);

        // Actualizar la actividad
        $actividad->update($request->all());

        return redirect()->route('actividades.index')->with('success', 'Actividad actualizada exitosamente.');
    }
}