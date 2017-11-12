<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$id = 1;
    	$condicion = array(
            'Registrado',
    		'Disponible | Almacen',
    		'Asignado a Equipo',
    		'Bueno | Retirado por ServTec',
    		'Dañado | Retirado por ServTec',
    		'Dañado | Almacen',
    		'Dañado | Equipo',
    		'Robado' 
    		);
        $c = 0;

        while ($c < 8) {
    		DB::table('estatus')->insert([
    			'id' => $id,
    			'condicion' => $condicion[$c]
    		]);

    		$id++;
            $c++;
    	}

    }
}
