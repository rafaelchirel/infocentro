<?php

namespace Infocentro\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Infocentro\Componente;
use Infocentro\Componentes;
use Infocentro\Control_Maquina;
use Infocentro\Equ_Comp;
use Infocentro\Equipo;
use Infocentro\Estatu;
use Infocentro\Historial;
use Infocentro\Http\Requests\EquipoRequets;
use Infocentro\Personal;

class EquipoController extends Controller {

    /*
    public function __construct() {
        Carbon::setLocale('es');
    }
    */
    
    public function index() {
        $habilitado = Equipo::all()->where('estatus', '=', 1);
        $inhabilitado = Equipo::all()->where('estatus', '=', 0);
        return view('equipo.index', ['habilitado' => $habilitado, 'inhabilitado' => $inhabilitado]);
    }

    public function create() {
        $componentes = DB::table('componentes as c')
        ->join('perifericos as p', 'c.periferico_id', '=', 'p.id')
        ->select('c.id', 'c.marca', 'c.modelo', 'c.serial', 'p.nombre as periferico', 'p.condicion')
        ->where('c.estatus_id', '=', 2)
        ->get();

        return view('equipo.create', ['componentes' => $componentes]);
    }

    public function store(EquipoRequets $request) {

        $equipo          = new Equipo();
        $equipo->numero  = $request->numero;
        $equipo->estatus = $request->estatus;
        //Condicion
        if ($request->estatus == '1') {
            $equipo->condicion = true;
        } else {
            $equipo->condicion = false;
        }
        $equipo->save();

        //estos datos seran ingresados en la tabla pivote de equipo_componentes
        $componente = $request->componente_id;

        $cont = 0;
        //Aqui mi bucle para recorrer mis componentes
        while ($cont < count($componente)) {
            $eq_comp = new Equ_Comp();
            $eq_comp->componente_id = $componente[$cont];
            $eq_comp->equipo_id = $equipo->id;
            $eq_comp->save();

            $comp = Componente::findOrFail($componente[$cont]);
            $comp->estatus_id = 3;
            $comp->update();

            Historial::insert([
                'fecha_hora'    => Carbon::now('America/Manaus'),
                'observacion'   => 'Componente vinculado al equipo ' . $equipo->numero,
                'estatus_id'    => 3,
                'componente_id' => $componente[$cont],
                'user_id'       => Auth::user()->id
            ]);

            $cont++;
        }
        flash('Equipo Registrado Exitosamente', 'success');
        return redirect('equipo');
    }

    //Metodo para la vista detalle equipo
    public function show($id) {
        $equipo = Equipo::all()->where('id', '=', $id);

        $compo_int = DB::table('equ_comp as ec')
                ->join('componentes as c', 'ec.componente_id', '=', 'c.id')
                ->join('perifericos as p', 'p.id', '=', 'c.periferico_id')
                ->select('ec.equipo_id', 'c.id as comp_id', 'c.marca', 'c.modelo', 'c.serial', 'c.descripcion', 'c.imagen', 'p.nombre as periferico', 'p.condicion')
                ->where('ec.equipo_id', '=', $id)
                ->where('p.condicion', '=', 0)
                ->get();

        $compo_ext = DB::table('equ_comp as ec')
                ->join('componentes as c', 'ec.componente_id', '=', 'c.id')
                ->join('perifericos as p', 'p.id', '=', 'c.periferico_id')
                ->select('ec.equipo_id', 'c.marca', 'c.id as comp_id', 'c.modelo', 'c.serial', 'c.descripcion', 'c.imagen', 'p.nombre as periferico', 'p.condicion')
                ->where('ec.equipo_id', '=', $id)
                ->where('p.condicion', '=', 1)
                ->get();
         //Modal
         $estatus = Estatu::all();
         $equipos = Equipo::all();     

        return view('equipo.detalle', ['compo_int' => $compo_int, 'compo_ext' => $compo_ext, 'equipo' => $equipo, 'estatus' => $estatus, 'equipos' => $equipos]);
    }

    //Metodo para editar un equipo
    public function edit($id) {
         $equipo = Equipo::findOrFail($id);

        $componentes = DB::table('componentes as c')
        ->join('perifericos as p', 'c.periferico_id', '=', 'p.id')
        ->select('c.id', 'c.marca', 'c.modelo', 'c.serial', 'p.nombre as periferico', 'p.condicion')
        ->where('c.estatus_id', '=', 2)
        ->get();

        return view('equipo.edit', ['componentes' => $componentes, 'equipo' => $equipo]);
    }

    public function update(EquipoRequets $request, $id) {
        $equipo = Equipo::findOrFail($id);
        
        if ($request->estatus == '1') {
            $condicion = true;
        } else {
            $condicion = false;
        }
        
        $equipo->fill(['numero' => $request->numero, 'estatus' => $request->estatus, 'condicion' => $condicion]);
        $equipo->save();

        //estos datos seran ingresados en la tabla pivote de equipo_componentes
        $componente = $request->componente_id;

        $cont = 0;
        //Aqui mi bucle para recorrer mis componentes
        if ($componente) {
            while ($cont < count($componente)) {
                $eq_comp = new Equ_Comp();
                $eq_comp->componente_id = $componente[$cont];
                $eq_comp->equipo_id = $equipo->id;
                $eq_comp->save();

                $comp = Componente::findOrFail($componente[$cont]);
                $comp->estatus_id = 3;
                $comp->update();

                Historial::insert([
                    'fecha_hora'    => Carbon::now('America/Manaus'),
                    'observacion'   => 'Componente vinculado al equipo ' . $equipo->numero,
                    'estatus_id'    => 3,
                    'componente_id' => $componente[$cont],
                    'user_id'       => Auth::user()->id
                ]);
                $cont++;
            }
        }
        flash('Equipo Nro.' . $equipo->numero . ' <b>actualizado</b> existosamente.', 'info');
        return redirect('equipo');
    }

//cambiar el estatus del equipo a habilitado
    public function habilitar($id) {
        $equipo = Equipo::findOrFail($id);
        $equipo->estatus = 1;
        $equipo->condicion = 1;
        $equipo->update();
        flash('Equipo Nro.' . $equipo->numero . ' <b>Habilitado</b> existosamente.', 'success');
        return redirect('equipo');
    }

//cambiar el estatus del equipo a inhhabilitado
    public function inhabilitar($id) {
        $equipo = Equipo::findOrFail($id);
        $equipo->estatus = 0;
        $equipo->condicion = 0;
        $equipo->update();
        flash('Equipo Nro.' . $equipo->numero . ' <b>Inhabilitado</b> existosamente.', 'danger');
        return redirect('equipo');
    }

    //control equipo

    function control() {
        $usuarios = Personal::all();
        $equipo = Equipo::all()->where('condicion', '=', 1);
        $control_maquina = DB::table('control_maquinas as cm')
        ->join('usu_per as u', 'cm.usu_per_id', '=', 'u.id')
        ->join('equipos as e', 'cm.equipo_id', '=', 'e.id')
        ->select('u.id as id_u', 'u.nombre', 'u.apellido', 'e.numero', 'cm.fecha_hora_entrada as entrada', 'cm.condicion', 'cm.id as id_cm', 'e.id as id_e')
        ->where('cm.condicion', '=', 1)
        ->get();
        return view('equipo.control', ['usuarios' => $usuarios, 'equipo' => $equipo, 'control_maquina' => $control_maquina]);
    }

    function AsignarEquipo(Request $request) {
        $date = Carbon::now('America/Manaus');

        $control_equipo = new Control_Maquina;
        $control_equipo->fecha_hora_entrada = $date->toDateTimeString();
        $control_equipo->condicion = 1;
        $control_equipo->usu_per_id = (int) $request->get('usu_per_id');
        $control_equipo->equipo_id = (int) $request->get('equipo_id');
        $control_equipo->save();

        $equipo = Equipo::findOrFail((int) $request->get('equipo_id'));
        $equipo->condicion = 0;
        $equipo->save();
        flash('Equipo Nro.' . $equipo->numero . ' <b>Asignado</b> existosamente.', 'success');
        return redirect('equipo-control');
    }

    function FinalizarEquipo($id_cm, $id_e) {
        $date = Carbon::now('America/Manaus');

        $control_equipo = Control_Maquina::findOrFail((int) $id_cm);
        $control_equipo->fecha_hora_salida = $date->toDateTimeString();
        $control_equipo->condicion = 0;
        $control_equipo->update();

        $equipo = Equipo::findOrFail((int) $id_e);
        $equipo->condicion = 1;
        $equipo->update();
        flash('Equipo Nro.' . $equipo->numero . ' <b>Finalizado</b> existosamente.', 'info');
        return redirect('equipo-control');
    }

    //imprimir ficha de equipo
    public function ficha_equipo($id) {

        $equipo = Equipo::all()->where('id', '=', $id);

        $compo_int = DB::table('equ_comp as ec')
                ->join('componentes as c', 'ec.componente_id', '=', 'c.id')
                ->join('perifericos as p', 'p.id', '=', 'c.periferico_id')
                ->select('ec.equipo_id','c.marca', 'c.modelo', 'c.serial', 'c.descripcion', 'c.imagen', 'p.nombre as periferico', 'p.condicion')
                ->where('ec.equipo_id', '=', $id)
                ->where('p.condicion', '=', 0)
                ->get();

        $compo_ext = DB::table('equ_comp as ec')
                ->join('componentes as c', 'ec.componente_id', '=', 'c.id')
                ->join('perifericos as p', 'p.id', '=', 'c.periferico_id')
                ->select('ec.equipo_id','c.marca', 'c.modelo', 'c.serial', 'c.descripcion', 'c.imagen', 'p.nombre as periferico', 'p.condicion')
                ->where('ec.equipo_id', '=', $id)
                ->where('p.condicion', '=', 1)
                ->get();

        $cintillo = \Infocentro\Institucion::first();

        $fecha = Carbon::now('America/Manaus')->format('d-m-Y');
        $hora = Carbon::now('America/Manaus')->format('h:i:s A');
        $date = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;
        /*
          return view('equipo.ficha-equipo', ['cintillo' => $cintillo, 'date' => $date, 'equipo_componente' => $equipo_componente]);
         */
        $pdf = \PDF::loadView('equipo.ficha-equipo', ['cintillo' => $cintillo, 'date' => $date, 'equipo' => $equipo, 'compo_int' => $compo_int, 'compo_ext' => $compo_ext]);
        return $pdf->stream();
    }

}
