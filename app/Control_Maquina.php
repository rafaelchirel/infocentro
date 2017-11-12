<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Control_Maquina extends Model {

    protected $table = 'control_maquinas';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'fecha_hora_entrada',
        'fecha_hora_salida',
        'condicion',
        'usu_per_id',
        'equipo_id'
    ];
    protected $guarded = [];

}
