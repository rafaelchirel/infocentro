<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model {

    protected $table = 'cargos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'nombre',
        'condicion'
    ];
    protected $guarded = [];

}
