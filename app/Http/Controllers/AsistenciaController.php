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
        $query = Asistencia::query(); 

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
        $asistencias = $query->paginate($perPage);

        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $actividades = Actividad::all();
        return view('asistencias.create', compact('actividades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|string',
            'sector' => 'required|string|max:255',
            'actividad_id' => 'required|exists:actividades,id',
        ]);

        Asistencia::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'sector' => $request->sector,
            'actividad_id' => $request->actividad_id,
            'fecha_asistencia' => now(), 
        ]);

        return redirect()->route('asistencias.index')->with('success', 'Asistencia registrada correctamente.');
    }

    public function estadisticas()
    {
        $asistenciasSemanales = Asistencia::select('actividad_id', DB::raw('count(*) as total'))
                                        ->whereBetween('fecha_asistencia', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                        ->groupBy('actividad_id')
                                        ->get();
    
        $asistenciasMensuales = Asistencia::select('actividad_id', DB::raw('count(*) as total'))
                                        ->whereMonth('fecha_asistencia', Carbon::now()->month)
                                        ->whereYear('fecha_asistencia', Carbon::now()->year)
                                        ->groupBy('actividad_id')
                                        ->get();
    
        $asistenciasAnuales = Asistencia::select('actividad_id', DB::raw('count(*) as total'))
                                        ->whereYear('fecha_asistencia', Carbon::now()->year)
                                        ->groupBy('actividad_id')
                                        ->get();
    
        $asistenciasPorActividad = Asistencia::select('actividad_id', DB::raw('count(*) as total'))
                                            ->groupBy('actividad_id')
                                            ->get();
    
        // Obtener todas las actividades para usar sus nombres en las etiquetas
        $actividades = Actividad::all(); 
    
        return view('asistencias.estadisticas', compact(
            'asistenciasSemanales', 
            'asistenciasMensuales',
            'asistenciasAnuales', 
            'asistenciasPorActividad',
            'actividades' 
        ));
    }
}