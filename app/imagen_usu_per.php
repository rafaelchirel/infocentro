<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Imagen_usu_per extends Model {

    protected $table = 'imagen_usu_per';
    protected $primaryKey = 'usu_per_id';
    public $timestamps = false;
    protected $filiable = [
        'url',
        'usu_per_id'
    ];
    protected $guarded = [];

}
