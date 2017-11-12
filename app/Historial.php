<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table = 'historial';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'fecha_hora',
        'observacion',
        'estatus_id',
        'componente_id',
        'user_id',
    ];
    protected $guarded = [];
}
