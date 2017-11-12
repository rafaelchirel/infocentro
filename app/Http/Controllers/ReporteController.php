<?php

namespace Infocentro\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use Illuminate\Support\Facades\DB;
use Infocentro\Componente;
use Infocentro\Equ_Comp;
use Infocentro\Equipo;
use Infocentro\Periferico;
use Infocentro\Personal;
use Infocentro\Redsocial;
use Infocentro\User;

class ReporteController extends Controller
{
	//Metodo / Buscar usuario-Personal por Cedula
    public function Usu_Per_Cedula($ced){
    	if($ced){
    		$usu_per = Personal::where('cedula', '=', $ced)->first();
    		if ($usu_per) {
				$personal = DB::table('usu_per as p')
				->join('imagen_usu_per as i', 'p.id', '=', 'i.usu_per_id')
				->select('p.id', 'p.cedula', 'p.nombre', 'p.apellido', 'p.genero', 'p.fecha_nac', 'p.email', 'p.telefono', 'p.direccion', 'i.url as imagen')
				->where('p.id', '=', $usu_per->id)
				->get();
				$rs = DB::table('redsocial_usu_per as rsu')
				->join('redes_sociales as rs', 'rs.id', '=', 'rsu.red_social_id')
				->select('rs.nombre', 'rs.tipo', 'rs.icono', 'rsu.url')
				->where('rsu.persona_id', '=', $usu_per->id)
				->get();
				$cintillo = \Infocentro\Institucion::first();

				$fecha = Carbon::now('America/Manaus')->format('d-m-Y');
				$hora  = Carbon::now('America/Manaus')->format('h:i:s A');
				$date  = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
				//View personal / reutilizando el codigo
				$pdf = \PDF::loadView('personal.ficha-personal-PDF', ['personal' => $personal, 'rs' => $rs, 'cintillo' => $cintillo, 'date' => $date]);
        		return $pdf->stream();
    		} else {
    			return response()->json(['success' => 'false', 'cedula' => 'Cedula no encontrada.']);
    		}
    	}
    			return response()->json(['error' => true], 404);
   }

   //Metodo / Buscar usuario-Personal de forma avanzada
    public function Usu_Per_Avanzado(Request $request){
    	if ($request->genero == 1) {
    		$users = DB::table('usu_per as p')
				->join('imagen_usu_per as i', 'p.id', '=', 'i.usu_per_id')
				->join('cargos as c', 'p.cargo_id', '=', 'c.id')
				->select('p.id', 'p.cedula', 'p.nombre', 'p.apellido', 'p.genero', 'p.fecha_nac', 'p.email', 'p.telefono', 'p.direccion', 'p.cargo_id', 'i.url as imagen')
				->where('p.cargo_id', '=', $request->cargo)
				->get();
    	} else {
    		$users = DB::table('usu_per as p')
				->join('imagen_usu_per as i', 'p.id', '=', 'i.usu_per_id')
				->join('cargos as c', 'p.cargo_id', '=', 'c.id')
				->select('p.id', 'p.cedula', 'p.nombre', 'p.apellido', 'p.genero', 'p.fecha_nac', 'p.email', 'p.telefono', 'p.direccion', 'p.cargo_id', 'i.url as imagen')
				->where('p.cargo_id', '=', $request->cargo)
				->where('p.genero', '=', ($request->genero == 'M') ? $request->genero : $request->genero)
				->get();
    	}
    		$cont = 0;
	    	foreach ($users as $per) {
	    		$edad = Carbon::createFromDate(Carbon::parse($per->fecha_nac)->format('Y'),Carbon::parse($per->fecha_nac)->format('m'),Carbon::parse($per->fecha_nac)->format('d'))->age;
    			$rs = DB::table('redsocial_usu_per as rsu')
				->join('redes_sociales as rs', 'rs.id', '=', 'rsu.red_social_id')
				->select('rs.nombre', 'rs.tipo', 'rs.icono', 'rsu.url')
				->where('rsu.persona_id', '=', $per->id)
				->get();

	    			$array[$cont]['cedula']    = $per->cedula;
	    			$array[$cont]['nombre']    = $per->nombre;
	    			$array[$cont]['apellido']  = $per->apellido;
	    			$array[$cont]['genero']    = $per->genero;
	    			$array[$cont]['fecha_nac'] = $per->fecha_nac;
	    			$array[$cont]['email']     = $per->email;
	    			$array[$cont]['telefono']  = $per->telefono;
	    			$array[$cont]['direccion'] = $per->direccion;
	    			$array[$cont]['imagen']    = $per->imagen;
	    			$array[$cont]['edad']      = $edad;
	    			if (count($rs) > 0) {
	    				foreach ($rs as $red_social) {
	    					$array[$cont]['rs'][] = [
	    						$red_social->nombre,
	    						$red_social->url,
	    					];
	    				}
	    			} else {
	    				$array[$cont]['rs'] = false;
	    			}
	    			$cont++;
	    	}

    	if ($request->edad == 2) {
    		$array = null;
	    	$ran_1 = (int)substr($request->rango, 0, -3);
	    	$ran_2 = (int)substr($request->rango, 3, 5);
	    	$cont = 0;

	    	foreach ($users as $per) {
	    		$edad = Carbon::createFromDate(Carbon::parse($per->fecha_nac)->format('Y'),Carbon::parse($per->fecha_nac)->format('m'),Carbon::parse($per->fecha_nac)->format('d'))->age;
	    		if ($edad >= $ran_1 && $edad <= $ran_2) {

	    			$rs = DB::table('redsocial_usu_per as rsu')
					->join('redes_sociales as rs', 'rs.id', '=', 'rsu.red_social_id')
					->select('rs.nombre', 'rs.tipo', 'rs.icono', 'rsu.url')
					->where('rsu.persona_id', '=', $per->id)
					->get();

	    			$array[$cont]['cedula']    = $per->cedula;
	    			$array[$cont]['nombre']    = $per->nombre;
	    			$array[$cont]['apellido']  = $per->apellido;
	    			$array[$cont]['genero']    = $per->genero;
	    			$array[$cont]['fecha_nac'] = $per->fecha_nac;
	    			$array[$cont]['email']     = $per->email;
	    			$array[$cont]['telefono']  = $per->telefono;
	    			$array[$cont]['direccion'] = $per->direccion;
	    			$array[$cont]['imagen']    = $per->imagen;
	    			$array[$cont]['edad']      = $edad;
	    			if (count($rs) > 0) {
	    				foreach ($rs as $red_social) {
	    					$array[$cont]['rs'][] = [
	    						$red_social->nombre,
	    						$red_social->url,
	    					];
	    				}
	    			} else {
	    				$array[$cont]['rs'] = false;
	    			}
	    			$cont++;
	    		}
	    	}
	    		
    	}

    	if (empty($array)) {
    		flash('Resultado no encontrado', 'warning');
    		return redirect()->back();
    	}

    		$cintillo = \Infocentro\Institucion::first();
			$fecha = Carbon::now('America/Manaus')->format('d-m-Y');
			$hora  = Carbon::now('America/Manaus')->format('h:i:s A');
			$date  = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
			//View personal / reutilizando el codigo
			$pdf = \PDF::loadView('reporte.rep_usu_per', ['array' => $array, 'cintillo' => $cintillo, 'date' => $date]);
    		return $pdf->stream();
    		//return response()->json(['success' => true, 'url' => $url]);
    }

    //Reporte para equipo
    public function reporte_equipo(Request $request){
    	$array = [];
    	(int) $id_equ = $request->equipo;

    	if ($id_equ) {
    		if(is_array($id_equ)){
	    		for ($i=0; $i < count($id_equ); $i++) { 
	    			$array = array_merge($array, $this->cons_equi_bdd($id_equ[$i]));
	    		}
	    	}else{
	    		$array = $this->cons_equi_bdd($id_equ);
	    	}
    	}else{
    		$list_equ = Equipo::all();
    		foreach ($list_equ as $a) {
    			$array = array_merge($array, $this->cons_equi_bdd($a->id));
    		}
    	}
    		$cintillo = \Infocentro\Institucion::first();
			$fecha = Carbon::now('America/Manaus')->format('d-m-Y');
			$hora  = Carbon::now('America/Manaus')->format('h:i:s A');
			$date  = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
			//View personal / reutilizando el codigo
			$pdf = \PDF::loadView('reporte.rep_equipo', ['array' => $array, 'cintillo' => $cintillo, 'date' => $date]);
    		return $pdf->stream();
    }

    // Reporte para equipo / Vinculacion entre equipo y componente - true si hay relacion - fasle, de no haberlo
    public function cons_equi_bdd($id, $i = 0){
    	$equ_comp = Equ_Comp::where('equipo_id', '=', $id)->first();

    	if ($equ_comp) {
    		$equ_comp = DB::table('equ_comp as e_c')
    		->join('componentes as c', 'c.id', '=', 'e_c.componente_id')
    		->join('perifericos as p', 'p.id', '=', 'c.periferico_id')
    		->join('equipos as e', 'e.id', '=', 'e_c.equipo_id')
    		->select('e.id', 'e.numero', 'e.estatus', 'e.condicion', 'c.marca', 'c.modelo', 'c.serial', 'c.descripcion', 'p.nombre as periferico')
    		->where('e_c.equipo_id', '=', $id)
    		->get();
    		return $this->array_equipo($equ_comp, false);
    	}else{
    		$equ_comp = Equipo::findOrFail($id);
    		return $this->array_equipo($equ_comp, true);
    	}
    }
    // Reporte para equipo /
    public function array_equipo($equ_comp, $comp){
    	if ($comp) {
    		$a = $equ_comp;
    		$array[0]['num']  = $a->numero;
	    	$array[0]['est']  = $a->estatus;
	    	$array[0]['cond'] = $a->condicion;
		    $array[0]['comp'] = null;
    	}else{
    		foreach ($equ_comp as $a) {
    		$array[0]['num']  = $a->numero;
	    	$array[0]['est']  = $a->estatus;
	    	$array[0]['cond'] = $a->condicion;
	    		foreach ($equ_comp as $b) {
	    			$array[0]['comp'][] = [
	    				$b->periferico, $b->marca, $b->modelo, $b->serial, $b->descripcion 
	    			];
	    		}
    		break;
    		}
    	}
    	return $array;
    }

    //Reporte usuarios sistema
    public function list_user(){
    	$cintillo = \Infocentro\Institucion::first();
		$fecha = Carbon::now('America/Manaus')->format('d-m-Y');
		$hora  = Carbon::now('America/Manaus')->format('h:i:s A');
		$date  = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
		$pdf = \PDF::loadView('reporte.rep_users', ['array' => User::all(), 'cintillo' => $cintillo, 'date' => $date]);
		return $pdf->stream();
    }

    //Reporte / Componente
    public function view_componente(){
    	$estatus = DB::table('estatus as e')
    	->join('componentes as c', 'e.id', '=', 'c.estatus_id')
    	->select('e.id', 'e.condicion')
    	->pluck('condicion','id');
    	return view('reporte.componente', ['estatus' => $estatus]);
    }
    public function jquery_autocomplete_comp(){
    	$array = [];
    	$comp = Componente::all();
    	foreach ($comp as $c) {
    		array_push($array, $c->serial);
    	}
    	echo json_encode(array('suggestions' => $array));
    }

    public function rep_comp(Request $request){
    	$cintillo = \Infocentro\Institucion::first();
		$fecha = Carbon::now('America/Manaus')->format('d-m-Y');
		$hora  = Carbon::now('America/Manaus')->format('h:i:s A');
		$date  = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
			if ($request->componente) {
				$pdf = \PDF::loadView('reporte.rep_componente', ['array' => $this->bus_comp_ind($request->componente), 'cintillo' => $cintillo, 'date' => $date]);
	    	}else{
	    		$pdf = \PDF::loadView('reporte.rep_componente', ['array' => $this->bus_comp_gen($request->estatus, $request->condicion), 'cintillo' => $cintillo, 'date' => $date]);
	    	}
		return $pdf->stream();
    	
    }
    public function bus_comp_ind($serial){
    	$componente = DB::table('componentes as c')
	    	->join('perifericos as p', 'p.id', '=', 'c.periferico_id')
	    	->select('c.id as comp_id','p.nombre as periferico', 'c.marca', 'c.modelo', 'c.serial','c.descripcion')
	    	->where('c.serial', '=', $serial)
	    	->get();

	    	$historial = DB::table('historial as h')
	    	->join('users as u', 'u.id', '=', 'h.user_id')
	    	->join('estatus as e', 'e.id', '=', 'h.estatus_id')
	    	->select('h.componente_id as comp_id', 'h.fecha_hora', 'h.observacion', 'e.condicion as estatu', 'u.name as user')
	    	->get();

	    	return $this->array_comp($componente, $historial);
    }

    public function bus_comp_gen($est, $cond){
    	if ($cond == 1) {
    		$componente = DB::table('componentes as c')
	    	->join('perifericos as p', 'p.id', '=', 'c.periferico_id')
	    	->select('c.id as comp_id','p.nombre as periferico', 'c.marca', 'c.modelo', 'c.serial','c.descripcion')
	    	->where('c.estatus_id', '=', $est)
	    	->get();

	    	$historial = DB::table('historial as h')
	    	->join('users as u', 'u.id', '=', 'h.user_id')
	    	->join('estatus as e', 'e.id', '=', 'h.estatus_id')
	    	->select('h.componente_id as comp_id', 'h.fecha_hora', 'h.observacion', 'e.condicion as estatu', 'u.name as user')
	    	->get();

	    	return $this->array_comp($componente, $historial);
    	} else {
	    	$componente = DB::table('componentes as c')
	    	->join('perifericos as p', 'p.id', '=', 'c.periferico_id')
	    	->select('c.id as comp_id','p.nombre as periferico', 'c.marca', 'c.modelo', 'c.serial','c.descripcion')
	    	->where('c.estatus_id', '=', $est)
	    	->get();
	    	return $this->array_comp($componente);
    	}
    }
    public function array_comp($comp, $hist = false){
    	$array = [];
    	$i = 0;
    	foreach ($comp as $c) {
    		$array[$i]['periferico'] = $c->periferico;
    		$array[$i]['marca']      = $c->marca;
    		$array[$i]['modelo']     = $c->modelo;
    		$array[$i]['serial']     = $c->descripcion;
    		if ($hist) {
    			foreach ($hist as $h) {
    				if ($c->comp_id == $h->comp_id) {
    					$array[$i]['historial'][] = [
    					'fecha_hora'  => $h->fecha_hora,
    					'observacion' => $h->observacion,
    					'estatu'      => $h->estatu,
    					'user'        => $h->user
    				];
    			}
    			}
    		}
    		$i++;
    	}
    	return $array;
    }
    public function red_social(){
    	$cintillo = \Infocentro\Institucion::first();
		$fecha = Carbon::now('America/Manaus')->format('d-m-Y');
		$hora  = Carbon::now('America/Manaus')->format('h:i:s A');
		$date  = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
		$pdf = \PDF::loadView('reporte.rep_redsocial', ['array' => Redsocial::all(), 'cintillo' => $cintillo, 'date' => $date]);
		return $pdf->stream();
    }
    public function periferico(){
    	$cintillo = \Infocentro\Institucion::first();
		$fecha = Carbon::now('America/Manaus')->format('d-m-Y');
		$hora  = Carbon::now('America/Manaus')->format('h:i:s A');
		$date  = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
		$pdf = \PDF::loadView('reporte.rep_periferico', ['array' => Periferico::all(), 'cintillo' => $cintillo, 'date' => $date]);
		return $pdf->stream();
    }
    public function cintillo(){
    	$cintillo = \Infocentro\Institucion::first();
		$fecha = Carbon::now('America/Manaus')->format('d-m-Y');
		$hora  = Carbon::now('America/Manaus')->format('h:i:s A');
		$date  = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
		$pdf = \PDF::loadView('reporte.rep_cintillo', ['cintillo' => $cintillo, 'date' => $date]);
		return $pdf->stream();
    }

}
