<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model {

    protected $table = 'usu_per';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $filiable = [
        'cedula',
        'nombre',
        'apellido',
        'genero',
        'fecha_nac',
        'email',
        'telefono',
        'direccion',
        'eliminar',
        'cargo_id'
    ];
    protected $guarded = [];

}
