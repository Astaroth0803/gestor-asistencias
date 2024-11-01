<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'nombre_actividad',
    ];

    // Definición de la relación con Asistencia
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'actividad_id'); // Asegúrate de que 'actividad_id' sea el campo correcto
    }
}
