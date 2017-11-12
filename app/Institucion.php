<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model {

    protected $table = 'institucion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'nombre',
        'codigo',
        'direccion',
        'banner_1',
        'banner_2'
    ];
    protected $guarded = [];

}
