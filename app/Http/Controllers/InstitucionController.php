<?php

namespace Infocentro\Http\Controllers;

use Illuminate\Http\Request;
use Infocentro\Institucion;

class InstitucionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $institucion = Institucion::first();
        return view('institucion.index', ['institucion' => $institucion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('institucion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $institucion = new Institucion();
        $institucion->nombre = $request->nombre;
        $institucion->codigo = $request->codigo;
        $institucion->direccion = $request->direccion;

        //Manipulacion de imagen
        $img_1 = $request->file('banner_1');
        if ($img_1) {
            $name_1 = 'banner_1' . time() . '.' . $img_1->getClientOriginalExtension();
            $path = public_path() . '/img/cintillo/';
            $img_1->move($path, $name_1);
            $institucion->banner_1 = $name_1;
        }
        $img_2 = $request->file('banner_2');
        if ($img_2) {
            $name_2 = 'banner_2' . time() . '.' . $img_2->getClientOriginalExtension();
            $path = public_path() . '/img/cintillo/';
            $img_2->move($path, $name_2);
            $institucion->banner_2 = $name_2;
        }
        $institucion->save();
        flash('<b>Cintillo</b> registrado Exitosamente.', 'success');
        return redirect('institucion');
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
        $institucion = Institucion::first();
        return view('institucion.edit', ['institucion' => $institucion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $institucion = Institucion::findOrFail($id);
        $institucion->nombre = $request->nombre;
        $institucion->codigo = $request->codigo;
        $institucion->direccion = $request->direccion;

        //Manipulacion de imagen
        $img_1 = $request->file('banner_1');
        if ($img_1) {
            $name_1 = 'banner_1' . time() . '.' . $img_1->getClientOriginalExtension();
            $path = public_path() . '/img/cintillo/';
            \File::delete($path . $institucion->banner_1);
            $img_1->move($path, $name_1);
            $institucion->banner_1 = $name_1;
        }
        $img_2 = $request->file('banner_2');
        if ($img_2) {
            $name_2 = 'banner_2' . time() . '.' . $img_2->getClientOriginalExtension();
            $path = public_path() . '/img/cintillo/';
            \File::delete($path . $institucion->banner_2);
            $img_2->move($path, $name_2);
            $institucion->banner_2 = $name_2;
        }
        $institucion->update();
        flash('<b>Cintillo</b> Editado Exitosamente.', 'info');
        return redirect('institucion');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
