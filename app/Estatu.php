<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Estatu extends Model
{
    protected $table = 'estatus';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'condicion',
    ];
    
    protected $guarded = [];
}
