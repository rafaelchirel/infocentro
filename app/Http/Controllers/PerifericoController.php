<?php

namespace Infocentro\Http\Controllers;

use Illuminate\Http\Request;
use Infocentro\Componente;
use Infocentro\Http\Requests\PerifericoRequest;
use Infocentro\Periferico;


class PerifericoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $periferico_externo = Periferico::orderBy('id', 'desc')->where('condicion', '=', 1)->get();
        $periferico_interno = Periferico::orderBy('id', 'desc')->where('condicion', '=', 0)->get();
        return view('periferico.index', ['periferico_externo' => $periferico_externo, 'periferico_interno' => $periferico_interno]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('periferico.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PerifericoRequest $request) {
        $periferico = new Periferico($request->all());
        $periferico->save();
        flash('Periferico <b>' . $request->nombre . '</b> registrado existosamente.', 'success');
        return redirect('perifericos');
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
        return view('periferico.edit', ['periferico' => Periferico::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PerifericoRequest $request, $id) {
        $periferico = Periferico::findOrFail($id);
        $periferico->fill($request->all());
        $periferico->save();
        flash('Periferico <b>' . $request->nombre . '</b> actualizado exitosamente', 'info');
        return redirect('perifericos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $periferico = Periferico::findOrFail($id);

        $comp = Componente::where('periferico_id', '=', $id)->first();
        if(count($comp)){
            $periferico->eliminar = 0;
            $periferico->update();
            flash('Periferico <b>' . $periferico->nombre . '</b> No puede ser eliminado, esta siendo utilizado.', 'info');
            return redirect()->back();
        }else{
            flash('Periferico <b>' . $periferico->nombre . '</b> Eliminado exitosamente', 'danger');
            $periferico->delete();
            return redirect('perifericos');
        }
    }
}
