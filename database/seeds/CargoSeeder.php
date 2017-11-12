<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $id = 1;
        $nombre = array('Personal', 'Usuario', 'Facilitador', 'Brigadista', 'Comunidad');
        $condicion = array('1', '1', '0', '0', '0');
        $c = 0; //contador

        while ($c < 5) {
            DB::table('cargos')->insert([
                'id' => $id,
                'nombre' => $nombre[$c],
                'condicion' => $condicion[$c]
            ]);
            $c++;
            $id++;
        }
    }

}
