<?php

namespace Infocentro\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Infocentro\Actividad;
use Infocentro\Componente;
use Infocentro\Equipo;
use Infocentro\Periferico;
use Infocentro\Personal;
use Infocentro\Redsocial;
use Infocentro\Redsocial_usu_per;
use Infocentro\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Array multidimensional para los graficos
        $charts = [
            'Usuarios de la Comunidad' => [
                'Hombres' => Personal::where('cargo_id', '=', 2)->where('genero', '=', 'M')->count(),
                'Mujeres' => Personal::where('cargo_id', '=', 2)->where('genero', '=', 'F')->count(),
            ],
            'Personal'=> [
                'Hombres' => Personal::where('cargo_id', '=', 1)->where('genero', '=', 'M')->count(),
                'Mujeres' => Personal::where('cargo_id', '=', 1)->where('genero', '=', 'F')->count(),
            ],
            'Equipos' => [
                'Habilitados'   => Equipo::where('estatus','=',1)->count(),
                'Inhabilitados' => Equipo::where('estatus','=',0)->count()
            ],
            'Perifericos' => [
                //
            ],
            'Usuarios | Sistema' => [
                'Administrador'     => User::where('rol', '=', 1)->where('habilitado', '=', 1)->count(),
                'Moderador' => User::where('rol', '=', 0)->where('habilitado', '=', 1)->count()
            ],
            'Redes Sociales' => [
                //
            ]
        ];

        //Red Social
        $red_soc = Redsocial::all();
        foreach ($red_soc as $red) {
            $charts['Redes Sociales'][$red->nombre] = Redsocial_usu_per::where('red_social_id', '=', $red->id)->count();
        }
        //Perifericos
        $perifericos = Periferico::all();
        foreach ($perifericos as $per) {
            $charts['Perifericos'][$per->nombre] = Componente::where('periferico_id', '=', $per->id)->count();
        }

        //Calculando mes actividad
        $date = Carbon::now('America/Manaus');
        $endDate = $date->subMonth(1)->format('d-m-Y');;

        $indicador = [
            'Total Usuarios'          => Personal::where('cargo_id', '=', 2)->count(),
            'Total Personal'          => Personal::where('cargo_id', '=', 2)->count(),
            'Total Equipos'           => Equipo::count(),
            'Total Actividades 1 Mes' => Actividad::whereDate('fecha', '>=', $endDate)->count(),
            'Total Usuarios Sistema'  => User::count(),
            'Total Redes Sociales'    => Redsocial::count(),
            'Total Perifericos'       => Periferico::count(),
            'Total Componente'        => Componente::count()
        ];
        return view('home.home', ['indicador' => $indicador, 'charts' => $charts]);
    }
}
