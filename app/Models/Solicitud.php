<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $fillable = [
        'NRC',
        'asignatura',
        'detalle',
        'calificacion',
        'numeroAyudantias',
        'numeroTelefonico',
        'nombreProfesor',
        'estadoSolicitud',
        'tipoSolicitud'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
