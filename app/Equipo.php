<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model {

    protected $table = 'equipos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'numero',
        'estatus',
        'condicion'
    ];
    protected $guarded = [];

}
