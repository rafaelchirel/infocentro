<?php

namespace Infocentro\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Infocentro\Actividad;
use Infocentro\ActividadPersona;
use Infocentro\Cargo;
use Infocentro\Http\Requests\ActividadRequest;
use Infocentro\Personal;

class ActividadController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //ACTIVIDADES PROXIMAS A REALIZAR
    public function index() {
        $fecha_hoy = Carbon::now('America/Manaus')->format('Y-m-d');

        $actividades_hoy = DB::table('actividades')
                ->whereDate('fecha', '=', $fecha_hoy)
                ->orderBy('id', 'desc')
                ->get();
        $actividades_prox = DB::table('actividades')
                ->whereDate('fecha', '>', $fecha_hoy)
                ->orderBy('id', 'desc')
                ->get();
        return view('actividad.index', ['actividades_hoy' => $actividades_hoy, 'actividades_prox' => $actividades_prox]);
    }

    public function ActividadRealizada() {
        $fecha_hoy = Carbon::now('America/Manaus')->format('Y-m-d');

        $actividades_real = DB::table('actividades')
                ->whereDate('fecha', '<', $fecha_hoy)
                ->orderBy('id', 'desc')
                ->get();
        return view('actividad.realizadas', ['actividades_real' => $actividades_real]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('actividad.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActividadRequest $request) {
        $fecha = Carbon::parse($request->fecha)->format('Y-m-d');

        $actividad = new Actividad($request->all());
        $actividad->fecha = $fecha;
        $actividad->save();
        return redirect('actividad/' . $actividad->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //ASIGNACION DE PARTICIPANTE
    public function show($id) {
        $personal = Personal::all()->where('cargo_id', '=', 1);
        $usuario = Personal::all()->where('cargo_id', '=', 2);
        $cargo = Cargo::all()->where('condicion', '=', 0);

        $facilitador = DB::table('actividad_persona as ap')
                ->join('usu_per as m', 'ap.usu_per_id', '=', 'm.id')
                ->select('m.id', 'm.nombre', 'm.apellido', 'm.cedula', 'm.genero', 'm.fecha_nac', 'm.telefono', 'ap.id as act_id')
                ->where('ap.actividad_id', '=', $id)
                ->where('ap.cargo_id', '=', 3)
                ->orderBy('ap.id', 'desc')
                ->get();

        $brigadista = DB::table('actividad_persona as ap')
                ->join('usu_per as m', 'ap.usu_per_id', '=', 'm.id')
                ->select('m.id', 'm.nombre', 'm.apellido', 'm.cedula', 'm.genero', 'm.fecha_nac', 'm.telefono', 'ap.id as act_id')
                ->where('ap.actividad_id', '=', $id)
                ->where('ap.cargo_id', '=', 4)
                ->orderBy('ap.id', 'desc')
                ->get();

        $comunidad = DB::table('actividad_persona as ap')
                ->join('usu_per as m', 'ap.usu_per_id', '=', 'm.id')
                ->select('m.id', 'm.nombre', 'm.apellido', 'm.cedula', 'm.genero', 'm.fecha_nac', 'm.telefono', 'ap.id as act_id')
                ->where('ap.actividad_id', '=', $id)
                ->where('ap.cargo_id', '=', 5)
                ->orderBy('ap.id', 'desc')
                ->get();

        return view('actividad.asignar', ['actividad_id' => $id, 'personal' => $personal, 'usuario' => $usuario, 'cargo' => $cargo, 'actividad' => Actividad::findOrFail($id), 'facilitador' => $facilitador, 'brigadista' => $brigadista, 'comunidad' => $comunidad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('actividad.edit', ['actividad' => Actividad::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $actividad = Actividad::findOrFail($id);
        $actividad->fill($request->all());
        $actividad->update();
        flash('actividad editada exitosamente', 'info');
        return redirect('actividad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $actividad = Actividad::findOrFail($id);
        $actividad->delete();
        flash('Actividad eliminada exitosamente', 'danger');
        return redirect('actividad');
    }

    //ASIGNANDO MIEMBROS A ACTIVIDAD
    public function AsignarActividad(Request $request) {

        $cont = 0;
        while ($cont < count($request->miembro)) {
            $actividad_persona = new ActividadPersona();
            $actividad_persona->cargo_id     = (int) $request->cargo;
            $actividad_persona->actividad_id = (int) $request->actividad_id;
            $actividad_persona->usu_per_id   = (int) $request->miembro[$cont];
            $actividad_persona->save();
            $cont++;
        }
        return redirect('actividad/' . $actividad_persona->actividad_id);
    }

    //Eliminar miembro de una actividad
    public function EliminarMiembro($actividad_id, $miembro_id) {
        $miembro = ActividadPersona::findOrFail($miembro_id);
        $miembro->delete();
        flash('Miembro eliminado de la actividad exitosamente.', 'danger');
        return redirect('actividad/' . $actividad_id);
    }

    //imprimir ficha de la actividad
    public function ficha_actividad($id) {
        $actividad = Actividad::findOrFail($id);
        $facilitador = DB::table('actividad_persona as ap')
                ->join('actividades as a', 'ap.actividad_id', '=', 'a.id')
                ->join('usu_per as m', 'ap.usu_per_id', '=', 'm.id')
                ->join('cargos as c', 'ap.cargo_id', '=', 'c.id')
                ->select('c.nombre as cargo', 'm.cedula', 'm.nombre as nom_mie', 'm.apellido', 'm.genero', 'm.fecha_nac', 'm.telefono')
                ->where('a.id', '=', $id)
                ->where('c.id', '=', 3)
                ->get();
        $brigadista = DB::table('actividad_persona as ap')
                ->join('actividades as a', 'ap.actividad_id', '=', 'a.id')
                ->join('usu_per as m', 'ap.usu_per_id', '=', 'm.id')
                ->join('cargos as c', 'ap.cargo_id', '=', 'c.id')
                ->select('c.nombre as cargo', 'm.cedula', 'm.nombre as nom_mie', 'm.apellido', 'm.genero', 'm.fecha_nac', 'm.telefono')
                ->where('a.id', '=', $id)
                ->where('c.id', '=', 4)
                ->get();
        $comunidad = DB::table('actividad_persona as ap')
                ->join('actividades as a', 'ap.actividad_id', '=', 'a.id')
                ->join('usu_per as m', 'ap.usu_per_id', '=', 'm.id')
                ->join('cargos as c', 'ap.cargo_id', '=', 'c.id')
                ->select('c.nombre as cargo', 'm.cedula', 'm.nombre as nom_mie', 'm.apellido', 'm.genero', 'm.fecha_nac', 'm.telefono')
                ->where('a.id', '=', $id)
                ->where('c.id', '=', 5)
                ->get();

        $cintillo = \Infocentro\Institucion::first();

        $fecha = Carbon::now('America/Manaus')->format('d-m-Y');
        $hora = Carbon::now('America/Manaus')->format('h:i:s A');
        $date = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;

        $pdf = \PDF::loadView('actividad.ficha-actividad', ['cintillo' => $cintillo, 'date' => $date, 'actividad' => $actividad, 'facilitador' => $facilitador, 'brigadista' => $brigadista, 'comunidad' => $comunidad]);
        return $pdf->stream();
    }
}
