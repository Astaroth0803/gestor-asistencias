<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Asistencia;
use App\Models\Actividad;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        // Creamos una consulta para las asistencias
        $query = Asistencia::query(); 

        // Filtramos las asistencias según el parámetro 'filtro'
        if ($request->filled('filtro')) {
            switch ($request->filtro) {
                case 'semana':
                    $query->whereBetween('fecha_asistencia', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
                    break;
                case 'mes':
                    $query->whereMonth('fecha_asistencia', Carbon::now()->month)
                          ->whereYear('fecha_asistencia', Carbon::now()->year);
                    break;
                case 'anio':
                    $query->whereYear('fecha_asistencia', Carbon::now()->year);
                    break;
            }
        }

        // Filtrar por rango de fechas si están presentes
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha_asistencia', [
                $request->fecha_inicio,
                $request->fecha_fin
            ]);
        }

        // Paginación
        $perPage = $request->session()->get('per_page', 10); 
        if ($request->has('per_page')) {
            $request->session()->put('per_page', $request->input('per_page'));
        }

        // Ejecutamos la consulta y obtenemos las asistencias paginadas
        $asistencias = $query->paginate($perPage);

        // Devolvemos la vista con las asistencias
        return view('asistencias.index', compact('asistencias'));
    }
    public function estadisticas()
{
    // Total de asistencias
    $totalAsistencias = Asistencia::count();

    // Total de asistencias del día de hoy
    $totalAsistenciasHoy = Asistencia::whereDate('fecha_asistencia', Carbon::today())->count();

    // Asistencias semanales
    $asistenciasSemanales = Asistencia::select('actividad_id', DB::raw('count(*) as total'))
        ->whereBetween('fecha_asistencia', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->groupBy('actividad_id')
        ->get();

    // Asistencias mensuales
    $asistenciasMensuales = Asistencia::select('actividad_id', DB::raw('count(*) as total'))
        ->whereMonth('fecha_asistencia', Carbon::now()->month)
        ->whereYear('fecha_asistencia', Carbon::now()->year)
        ->groupBy('actividad_id')
        ->get();

    // Asistencias anuales
    $asistenciasAnuales = Asistencia::select('actividad_id', DB::raw('count(*) as total'))
        ->whereYear('fecha_asistencia', Carbon::now()->year)
        ->groupBy('actividad_id')
        ->get();

    // Asistencias por actividad
    $asistenciasPorActividad = Asistencia::select('actividad_id', DB::raw('count(*) as total'))
        ->groupBy('actividad_id')
        ->get();

    // Obtener todas las actividades
    $actividades = Actividad::all();

    // Pasar las variables a la vista
    return view('asistencias.estadisticas', compact(
        'totalAsistencias',
        'totalAsistenciasHoy',
        'asistenciasSemanales',
        'asistenciasMensuales',
        'asistenciasAnuales',
        'asistenciasPorActividad',
        'actividades'
    ));
}

    
    // Método para crear nuevas asistencias (si es necesario)
    public function create()
    {
        // Obtener todas las actividades para mostrarlas en la vista
        $actividades = Actividad::all();
        return view('asistencias.create', compact('actividades'));
    }

    // Método para almacenar nuevas asistencias
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|string',
            'sector' => 'required|string|max:255',
            'actividad_id' => 'required|exists:actividades,id',
        ]);

        // Crear una nueva asistencia
        Asistencia::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'sector' => $request->sector,
            'actividad_id' => $request->actividad_id,
            'fecha_asistencia' => now(),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    }
}
