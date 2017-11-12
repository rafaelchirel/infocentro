<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model {

    protected $table = 'actividades';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'nombre',
        'descripcion',
        'fecha',
        'hora_inicio',
        'hora_salida'
    ];
    protected $guarded = [];

}
