<?php

namespace Infocentro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Infocentro\Http\Requests\UserRequest;
use Infocentro\User;
use Intervention\Image\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Metodo para mostrar lista de usuarios y busqueda por filter
    public function index(Request $request)
    {
        if($request){
            if ($request->filter == 'habilitado') {
                $filter = 'habilitado';
                $users = DB::table('users')->where('habilitado', '=', 1)->paginate(10);
            } elseif($request->filter == 'inhabilitado'){
                $filter = 'inhabilitado';
                $users = DB::table('users')->where('habilitado', '=', 0)->paginate(10);
            }elseif($request->filter == 'administrador'){
                $filter = 'administrador';
                $users = DB::table('users')->where('rol', '=', 1)->paginate(10);
            }elseif($request->filter == 'moderador'){
                 $filter = 'moderador';
                $users = DB::table('users')->where('rol', '=', 0)->paginate(10);
            }else {
                $filter = trim($request->filter);
                $users = DB::table('users')->where('name', 'LIKE', '%' . $filter . '%')->orwhere('email', 'LIKE', '%' . $filter . '%')->paginate(10);
            }
        }
        return view('user.index', ['users' => $users, 'filter' => $filter]);
    }
    //Metodo para cambiar rol y habilitado del usuario
    public function accion($id, $accion){
        $user = User::findOrFail($id);
        //de Moderador a admin
        if($accion == 1): $user->rol = 1; $user->update();
        //De admin a Moderador
        elseif($accion == 2): $user->rol = 0; $user->update();  
        //Restaurar password
        elseif($accion == 3): $user->password = bcrypt('123456'); $user->update();
        //De Inhabilitado a habilitar
        elseif($accion == 4): $user->habilitado = 1; $user->update();  
        //De Habilitar a Inhabilitar
        elseif($accion == 5): $user->habilitado = 0; $user->update();  
        endif;

        flash('El cambio de accion ha sido procesado exitosamente...', 'success');
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user.edit',['user' => User::findOrFail(Auth::user()->id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Actualizar perfil users
    public function update(UserRequest $request, $id)
    {
        if ($request->ajax()) {
            $user            = User::findOrFail($id);
            $user->name      = $request->name;
            $user->email     = $request->email;
            $user->password  = bcrypt($request->password);
            $user->pregunta  = $request->pregunta;
            $user->respuesta = $request->respuesta;
            $user->avatar    = ($request->avatar) ? $this->avatar($request->avatar) : $request->avataraux;
            $user->update();
            return response()->json(['success' => 'true']);
        } else {
           return response()->json(['success' => 'false']);
        }
    }
    //Metodo para subir imagen
    protected function avatar($img)
    {
        if ($img) {
            $name = 'avatar_' . time() . '.' . $img->getClientOriginalExtension();
            $path = public_path('img/avatar/' . $name);
            \Image::make($img)->resize(200, 200)->save($path);
        }
        return $name;
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
    //Method mostrar perfil
    public function perfil(){
        return view('user.profile', ['user' => User::findOrFail(Auth::user()->id)]);
    }
    //Method Darme de baja
    public function DarmeDeBaja($id){
        $user = User::findOrFail($id);
        $user->habilitado = false;
        $user->update();
        return redirect()->back();
    }

    //Verificar email / true
    public function verificar_email($email){
        $cor_ele = User::where('email', '=', $email)->first();

        if($cor_ele){
            return response()->json(['email' => $email, 'pregunta' => $cor_ele->pregunta]);
        }
        return response()->json(['error' => true], 404);
    }

    public function pregunta_seguridad(Request $request){
        $date = User::where('email', '=', $request->email)->where('pregunta', '=', $request->preg)->where('respuesta', '=', $request->resp)->first();
        if ($date){
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => true], 404);
    }

    public function actualizar_password(Request $request){
        $date = User::where('email', '=', $request->email)->where('pregunta', '=', $request->preg)->where('respuesta', '=', $request->resp)->first();
         if ($date){
            $date->password = bcrypt($request->pas);
            $date->update();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => true], 404);
    }

    public function ResetPasViaEmail($email){
         $user = User::where('email', '=', $email)->first();

         if($user){

            $password = random_int(100000, 200000);
            $user->password = bcrypt($password);
            $user->update();

            $carbon = new \Carbon\Carbon();
            $date = $carbon->now('America/Manaus');

            Mail::send('auth.email', ['user' => $user, 'password' => $password, 'fecha' => $date], function($message) use ($user) {
                $message->from('infocentrovdlp@gmail.com', 'InfoCentro Padre Chacin');
                $message->to($user->email, $user->name);
                $message->subject('Se ha enviado su Contraseña...');
            });

        return response()->json(['success' => 'true']);
        }
        if(count($user) == 0){
            return response()->json(['email' => true], 404);
        }
        return response()->json(['error' => true], 500);
    }

}
