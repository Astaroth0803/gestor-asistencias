<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencias';

    protected $fillable = [
        'nombre',
        'apellido',
        'edad',
        'sexo',
        'sector',
        'actividad_id',
        'fecha_asistencia'
    ];

    // Definición de la relación con Actividad
    public function actividad()
    {
        return $this->belongsTo(Actividad::class, 'actividad_id'); // Asegúrate de que 'actividad_id' sea el campo correcto
    }

    protected $casts = [
        'fecha_asistencia' => 'date',
    ];
}
