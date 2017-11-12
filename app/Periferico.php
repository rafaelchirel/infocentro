<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Periferico extends Model
{
    protected $table = 'perifericos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'nombre',
        'condicion',
        'eliminar'
    ];
    protected $guarded = [];
}
