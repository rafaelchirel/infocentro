<?php

namespace Infocentro;

use Illuminate\Database\Eloquent\Model;

class Redsocial_usu_per extends Model {

    protected $table = 'redsocial_usu_per';
    protected $primaryKey = 'persona_id';
    public $timestamps = false;
    protected $filiable = [
        'url',
        'persona_id',
        'red_social_id'
    ];
    protected $guarded = [];

}
