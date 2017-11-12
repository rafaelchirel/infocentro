<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class ActividadPersona extends Model {

    protected $table = 'actividad_persona';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'cargo_id',
        'actividad_id',
        'usu_per_id',
    ];
    protected $guarded = [];

}
