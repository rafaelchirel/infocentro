<?php

namespace Infocentro\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Infocentro\Componente;
use Infocentro\Equ_Comp;
use Infocentro\Equipo;
use Infocentro\Estatu;
use Infocentro\Historial;
use Infocentro\Http\Requests\ComponenteRequets;
use Infocentro\Periferico;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Listar todos los estatus
    public function index()
    {
        $estatus = Estatu::all();
        for ($i=1; $i < 9; $i++) { 
            $componente = Componente::all()->where('estatus_id', '=', $i);
            $contador[] = count($componente);
        }
        return view('componente.index', ['estatus' => $estatus, 'contador' => $contador, 'i' => $i = 0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //view para registrar un nuevo componente
    public function create()
    {
        $perifericos = Periferico::all()->pluck('nombre', 'id');
        return view('componente.create', ['perifericos' => $perifericos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Registrar un nuevo componente
    public function store(ComponenteRequets $request)
    {
        try {
            //Abro capturador de sesiones
            DB::beginTransaction();

            $img = $request->file('imagen');
            //Manipulacion de imagen
            if($img){
                $request->imagen = 'componente_' . time() . '.' . $img->getClientOriginalExtension();
                $path = public_path('img/componentes/' . $request->imagen);
                //cambiando dimension imagen paquete intervention/image
                \Image::make($img)->resize(500, 500)->save($path);
            }else{
                $request->imagen = 'componente_vacio.jpg';
            }

            $componente = new Componente($request->all());
            $componente->imagen     = $request->imagen;
            $componente->estatus_id = 1;
            $componente->save();

            Historial::insert([
                'fecha_hora' => Carbon::now('America/Manaus'),
                'observacion' => '',
                'estatus_id' => 1,
                'componente_id' => $componente->id,
                'user_id' => Auth::user()->id
            ]);

        DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }  
        flash('Componente registrado Exitosamente', 'success');
        return redirect('componente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Listar todos los componentes segun su estatu
    public function show($id)
    {
        $componentes = DB::table('componentes as c')
        ->join('perifericos as p', 'c.periferico_id', '=', 'p.id')
        ->join('estatus as e', 'c.estatus_id', '=', 'e.id')
        ->select('c.marca', 'c.modelo', 'c.serial', 'c.descripcion', 'c.imagen', 'c.estatus_id', 'e.condicion as estatus', 'p.nombre as periferico', 'p.condicion', 'c.id as comp_id')
        ->where('e.id', '=', $id)
        ->orderBy('c.id', 'desc')
        ->paginate(5);

        $estatu = Estatu::all()->where('id', '=', $id)->first();
        $list_estatus = Estatu::all();
        return view('componente.list', ['componentes' => $componentes, 'estatu' => $estatu, 'list_estatus' => $list_estatus]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Mostrar detalle de cada componente - Historial
    public function detalle($id){
       $componente = DB::table('componentes as c')//table componente
       ->join('perifericos as p', 'c.periferico_id', '=', 'p.id')//perifericos
       ->join('estatus as e', 'c.estatus_id', '=', 'e.id')//estatus
       ->select('c.id as comp_id', 'c.marca', 'c.modelo', 'c.serial', 'c.descripcion', 'c.imagen', 'c.estatus_id', 'e.condicion as comp_estatus', 'p.nombre as periferico')
       ->where('c.id', '=', $id)
       ->get();

       $historial = DB::table('historial as h')//historial
       ->join('users as u', 'h.user_id', '=', 'u.id')//users
       ->join('estatus as e', 'h.estatus_id', '=', 'e.id')//estatus
       ->select('h.fecha_hora', 'h.observacion', 'e.condicion as estatus', 'u.name as user', 'u.avatar')
       ->where('h.componente_id', '=', $id)
       ->orderBy('h.id', 'desc')
       //->get();
       ->paginate(10);

       $equ_comp = DB::table('equ_comp')->where('componente_id', '=', $id)->first();

       $estatus = Estatu::all();
       $equipos = Equipo::all();

       return view('componente.detalle', ['equ_comp' => $equ_comp,'componente' => $componente, 'historial' =>  $historial, 'estatus' => $estatus, 'equipos' => $equipos]);
    }

    //metodo para cambiar el estatus del componente
    public function cambiar_estatus(Request $request){
        //Eliminar vinculacion de equipo componente
        $delete = DB::table('equ_comp')->where('componente_id', '=', $request->componente_id);
        $delete->delete();

        //actualizar nuevo estatus_id de componente
        $componente = Componente::findOrFail($request->componente_id);
        $componente->estatus_id = $request->estatus_id;
        $componente->update();

        //Buscando Numero equipo 
        if ($request->estatus_id == 3) {
            $equipo = Equipo::findOrFail((int) $request->equipo);
        }

        //campo observacion
        $observacion = ($request->estatus_id == 3) ? '<b>Equipo vinculado: ' . $equipo->numero . ' </b><br> ' . $request->observacion : $request->observacion;
        
        if ($request->estatus_id == 3) {
            //Registrar vinculacion equipo componente
            Equ_Comp::insert([
                'equipo_id'     => $request->equipo,
                'componente_id' => $request->componente_id
            ]);
            $this->historial($observacion, $request->estatus_id, $request->componente_id);

        }elseif ($request->estatus_id == 7) {

            if ($request->condicion == 1) {
                $observacion = '<b>Equipo vinculado: </b>' . $request->equipo_vinculado . ' - ' . $request->observacion;
                $this->historial($observacion, $request->estatus_id, $request->componente_id);
            } else {
                $observacion = '<b>Equipo vinculado: </b>' . $request->equipo;
                $this->historial($observacion, 3, $request->componente_id);

                $observacion = '<b>Equipo vinculado: </b>' . $request->equipo . ' - ' . $request->observacion;
                $this->historial($observacion, $request->estatus_id, $request->componente_id);
            }

        }else{
            $this->historial($observacion, $request->estatus_id, $request->componente_id);
        }
        
        if ($request->RedirectEquipo) {
            flash('El componente ha sido cambiado de <b>estatus</b> exitosamente.', 'success');
            return redirect('equipo/' . $request->RedirectEquipo);
        } else {
            flash('Estatus cambiado exitosamente.', 'success');
            return redirect('componente-detalle/' . $request->componente_id);
        }
        
    }

    //Metodo para guardar historial
    function historial($obs, $est_id, $comp_id){
        Historial::insert([
            'fecha_hora'    => Carbon::now('America/Manaus'),
            'observacion'   => $obs,
            'estatus_id'    => $est_id,
            'componente_id' => $comp_id,
            'user_id'       => Auth::user()->id
        ]);
    }

    //Metood para consultar si el componente esta vinculado con un equipo
    public function compo_equipo(){
        //
    }

}
