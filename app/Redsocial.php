<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Redsocial extends Model {

    protected $table = 'redes_sociales';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'nombre',
        'tipo',
        'icono'
    ];
    protected $guarded = [];

}
