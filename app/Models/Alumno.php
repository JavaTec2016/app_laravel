<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_control',
        'nombre',
        'primer_ap',
        'segundo_ap',
        'fecha_nac',
        'semestre',
        'carrera',
    ];
}
