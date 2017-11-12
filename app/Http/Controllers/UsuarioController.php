<?php

namespace Infocentro\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Infocentro\Http\Requests\Usu_PerRequest;
use Infocentro\Imagen_usu_per;
use Infocentro\Personal;
use Infocentro\Redsocial_usu_per;
use Infocentro\Traits\ImagenUsuPerTrait;
use Intervention\Image\Image;

class UsuarioController extends Controller {
      use ImagenUsuPerTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        Carbon::setLocale('es');
    }

    public function index(Request $request) {
        if ($request) {
            $query = trim($request->get('searchText'));
            $personal = DB::table('usu_per as p')
                    //relacion
                    ->join('imagen_usu_per as i', 'p.id', '=', 'i.usu_per_id')
                    //selecciono mis campos
                    ->select('p.nombre', 'p.apellido', 'p.cedula', 'p.genero', 'p.email', 'p.telefono', 'i.url', 'p.id', 'p.eliminar')
                    //primera busqueda
                    ->where('cargo_id', '=', 2)
                    ->where('cedula', 'LIKE', '%' . $query . '%')
                    //segunda busqueda
                    ->orwhere('nombre', 'LIKE', '%' . $query . '%')
                    ->where('cargo_id', '=', 2)
                    //tercera busqueda
                    ->orwhere('apellido', 'LIKE', '%' . $query . '%')
                    ->where('cargo_id', '=', 2)
                    //metodo get
                    ->orderBy('p.id', 'desc')
                    ->paginate(9);
        }
        return view('usuario.index', ['personal' => $personal, 'searchText' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $red_social = DB::table('redes_sociales')->get();
        return view('usuario.create', ['red_social' => $red_social]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Usu_PerRequest $request) {
        if ($request->ajax()) {
            try {
                //Abro capturador de sesiones
                DB::beginTransaction();
                //Formateando fecha
                $fecha = Carbon::parse($request->fecha_nac)->format('Y-m-d');
                //estos datos seran ingreasos en tabla usu_per
                $personal = Personal::create([
                    'cedula'    => $request['cedula'],
                    'nombre'    => $request['nombre'],
                    'apellido'  => $request['apellido'],
                    'genero'    => $request['genero'],
                    'fecha_nac' => $fecha,
                    'email'     => $request['email'],
                    'telefono'  => $request['telefono'],
                    'direccion' => $request['direccion'],
                    'cargo_id'  => 2,
                ]);

                //Manipulacion de imagen - Trait
                $this->ImagenStoreTrait(2, $request->file('imagen'), $personal->id, $request->genero);

                //estos datos seran ingresados en la tabla pivote de red_social_usu_per
                $red_social = $request->get('id_red_social');
                $url = $request->get('url_red_social');
                $cont = 0;

                while ($cont < count($red_social)) {
                    //valido para insertar los campos con valores.
                    if (trim($url[$cont]) == true) {
                        //Aqui estoy instanciando la tabla pivote para hacer el recorrido
                        $pivote = new Redsocial_usu_per();
                        $pivote->url = $url[$cont];
                        $pivote->persona_id = $personal->id;
                        $pivote->red_social_id = $red_social[$cont];
                        $pivote->save();
                    }
                    $cont++;
                }
            flash('Usuario <b>' . $personal->nombre . ' ' . $personal->apellido . ' </b>registrado existosamente.', 'success');
                //Cierto capturador de sesiones
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }
            return response()->json(['success' => 'true']);
        } else {
            return response()->json(['success' => 'false']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //metodo para ver los detalles del personal
    public function show($id) {
        $personal = DB::table('usu_per as p')
                ->join('imagen_usu_per as i', 'p.id', '=', 'i.usu_per_id')
                ->select('p.id', 'p.cedula', 'p.nombre', 'p.apellido', 'p.genero', 'p.fecha_nac', 'p.email', 'p.telefono', 'p.direccion', 'p.eliminar', 'i.url as imagen')
                ->where('p.id', '=', $id)
                ->get();

        $rs = DB::table('redsocial_usu_per as rsu')
                ->join('redes_sociales as rs', 'rs.id', '=', 'rsu.red_social_id')
                ->select('rs.nombre', 'rs.icono', 'rsu.url', 'rs.tipo')
                ->where('rsu.persona_id', '=', $id)
                ->get();

        return view('usuario.detalle', ['personal' => $personal, 'rs' => $rs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $personal = DB::table('usu_per as p')
                ->join('imagen_usu_per as i', 'p.id', '=', 'i.usu_per_id')
                ->select('p.id', 'p.cedula', 'p.nombre', 'p.apellido', 'p.genero', 'p.fecha_nac', 'p.email', 'p.telefono', 'p.direccion', 'i.url as imagen', 'cargo_id')
                ->where('p.id', '=', $id)
                ->first();

        $rs_per = DB::table('redsocial_usu_per as rsu')
                ->join('redes_sociales as rs', 'rs.id', '=', 'rsu.red_social_id')
                ->select('rs.nombre', 'rsu.url', 'rsu.red_social_id as id', 'rs.tipo')
                ->where('rsu.persona_id', '=', $id)
                ->get();

        $rs = DB::table('redes_sociales')->get();

        return view('usuario.edit', ['personal' => $personal, 'rs' => $rs, 'rs_per' => $rs_per]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Usu_PerRequest $request, $id) {
        if ($request->ajax()) {
          
            $this->DeleteRedSocial($id);
            //Formateando fecha
            $fecha = Carbon::parse($request->fecha_nac)->format('Y-m-d');
            
            $personal = Personal::findOrFail($id);
            $personal->cargo_id  = $request->get('cargo_id');
            $personal->cedula    = $request->get('cedula');
            $personal->nombre    = $request->get('nombre');
            $personal->apellido  = $request->get('apellido');
            $personal->genero    = $request->get('genero');
            $personal->fecha_nac = $fecha;
            $personal->email     = $request->get('email');
            $personal->telefono  = $request->get('telefono');
            $personal->direccion = $request->get('direccion');
            $personal->update();

            //Manipulacion de imagen - Trait
            $this->ImagenUpdateTrait(2, $request->file('imagen'), $id, $request->condicion_img, $personal->genero);

            //estos datos seran ingresados en la tabla pivote de red_social_usu_per
            $red_social = $request->get('id_red_social');
            $url = $request->get('url_red_social');
            $cont = 0;

            while ($cont < count($red_social)) {
                //valido para insertar los campos con valores.
                if (trim($url[$cont]) == true) {
                    //Aqui estoy instanciando la tabla pivote para hacer el recorrido
                    $pivote = new Redsocial_usu_per();
                    $pivote->url           = $url[$cont];
                    $pivote->persona_id    = (int) $id;
                    $pivote->red_social_id = (int) $red_social[$cont];
                    $pivote->save();
                }
                $cont++;
            }

            flash('Usuario <b>' . $personal->nombre . ' ' . $personal->apellido . ' </b>editado existosamente.', 'info');
            return response()->json(['success' => 'true', 'cargo' => $personal->cargo_id, 'id' => $personal->id]);
        } else {
             return response()->json(['success' => 'false']);
        }
    }

    //Metodo para eliminar las redes sociales
    public function DeleteRedSocial($id) {
        $rs_per = DB::table('redsocial_usu_per as rsu')
                ->join('redes_sociales as rs', 'rs.id', '=', 'rsu.red_social_id')
                ->select('rs.nombre', 'rsu.url', 'rsu.red_social_id as id')
                ->where('rsu.persona_id', '=', $id)
                ->get();
        if (count($rs_per) != 0) {
            Redsocial_usu_per::findOrFail($id)->delete();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Metodo para eliminar
    public function destroy($id) {
        $personal = Personal::findOrFail($id);

        $cont_maqu = \Infocentro\Control_Maquina::all()->where('usu_per_id', '=', $id);
        $act_per = \Infocentro\ActividadPersona::all()->where('usu_per_id','=', $id);

        if (count($cont_maqu) == 0 && count($act_per) == 0) {

            flash('Usuario <b>' . $personal->nombre . ' ' . $personal->apellido . ' </b>eliminado existosamente.', 'danger');
            //eliminar imagen siempre y cuando sea diferente de M.jpg y F.jpj
            $imagen_per = Imagen_usu_per::findOrFail($id);
            if ($imagen_per->url != "M.jpg" && $imagen_per->url != "F.jpg") {
                $path = public_path() . '/img/usu_per/';
                \File::delete($path . $imagen_per->url);
            }
            $personal->delete();
            return redirect('usuario');

        } else {
            flash('El usuario ' . $personal->nombre . ' ' . $personal->apellido . ' no puede ser eliminado porque tiene relacion con otros modulos.', 'info');
            $personal->eliminar = false;
            $personal->update();
            return redirect('usuario');
        }
    }

    public function ficha_personal($id) {
        $personal = DB::table('usu_per as p')
                ->join('imagen_usu_per as i', 'p.id', '=', 'i.usu_per_id')
                ->select('p.id', 'p.cedula', 'p.nombre', 'p.apellido', 'p.genero', 'p.fecha_nac', 'p.email', 'p.telefono', 'p.direccion', 'i.url as imagen')
                ->where('p.id', '=', $id)
                ->get();
        $rs = DB::table('redsocial_usu_per as rsu')
                ->join('redes_sociales as rs', 'rs.id', '=', 'rsu.red_social_id')
                ->select('rs.nombre', 'rs.tipo', 'rs.icono', 'rsu.url')
                ->where('rsu.persona_id', '=', $id)
                ->get();
        $cintillo = \Infocentro\Institucion::first();

        $fecha = Carbon::now('America/Manaus')->format('d-m-Y');
        $hora = Carbon::now('America/Manaus')->format('h:i:s A');
        $date = 'Fecha: ' . $fecha . ' ' . 'Hora: ' . $hora;

        $pdf = \PDF::loadView('usuario.ficha-personal-PDF', ['personal' => $personal, 'rs' => $rs, 'cintillo' => $cintillo, 'date' => $date]);
        return $pdf->stream();
    }

}
