<?php

namespace Infocentro\Http\Controllers;

use Illuminate\Http\Request;
use Infocentro\Http\Requests\RedSocialRequest;
use Infocentro\Redsocial;

class RedSocialController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $red_social = Redsocial::all();
        return view('red_social.index', ['red_social' => $red_social]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('red_social.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RedSocialRequest $request) {
        if ($request->ajax()) {
            $red_social = new Redsocial();
            $red_social->nombre = $request->nombre;
            $red_social->tipo = $request->tipo;

            //Manipulacion de imagen
            $img = $request->file('icono');
            $name = 'red_social_' . time() . '.' . $img->getClientOriginalExtension();
            $path = public_path() . '/img/red_social/';
            $img->move($path, $name);
            $red_social->icono = $name;

            $red_social->save();

            flash('Red Social <b>' . $request->nombre . ' </b>registrado existosamente.', 'success');
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
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('red_social.edit', ['red_social' => Redsocial::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RedSocialRequest $request, $id) {
        $red_social = Redsocial::findOrFail($id);
        $red_social->nombre = $request->nombre;
        $red_social->tipo = $request->tipo;

        //Manipulacion de imagen
        $img = $request->file('icono');
        if ($img) {
            $name = 'red_social_' . time() . '.' . $img->getClientOriginalExtension();
            $path = public_path() . '/img/red_social/';
            $img->move($path, $name);
            $red_social->icono = $name;
            \File::delete($path . $request->icono_a);
        }
        $red_social->save();
        flash('Red Social <b>' . $request->nombre . ' </b>actualizada existosamente.', 'info');
        return redirect('red-social');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $red_social = Redsocial::findOrFail($id);
        flash('Red Social <b>' . $red_social->nombre . ' </b>eliminado existosamente.', 'danger');
        $path = public_path() . '/img/red_social/';
        \File::delete($path . $red_social->icono);
        $red_social->delete();

        return redirect('red-social');
    }

}
