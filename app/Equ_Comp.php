<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Equ_Comp extends Model
{
    protected $table = 'equ_comp';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'equipo_id',
        'componente_id',
    ];
    
    protected $guarded = [];
}
