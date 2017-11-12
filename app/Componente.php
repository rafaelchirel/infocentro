<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $table = 'componentes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'marca',
        'modelo',
        'serial',
        'descripcion',
        'imagen',
        'estatus_id',
        'periferico_id',
    ];
    protected $guarded = [];
}
