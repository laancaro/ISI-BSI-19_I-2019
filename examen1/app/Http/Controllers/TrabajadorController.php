<?php

namespace App\Http\Controllers;

use App\trabajador;
use Illuminate\Http\Request;

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $trabajador = trabajador::latest()->paginate(5);
  
        return view('trabajador.index',compact('trabajador'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trabajador.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'nombre' => 'required',
            'cedula' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'distrito' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'celular' => 'required',
            'correo' => 'required',
            'ocupacion' => 'required',
            'grado_academico' => 'required',
            'fecha_nacimiento' => 'required',
            'banco' => 'required',
            'num_cuenta_banco' => 'required',  
             ]);
         trabajador::create($request->all());
   
        return redirect()->route('trabajador.index')
                        ->with('success','trabajador created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function show(trabajador $trabajador)
    {
        return view('trabajador.show',compact('trabajador'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function edit(trabajador $trabajador)
    {
        return view('trabajador.edit',compact('trabajador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trabajador $trabajador)
    {
        $request->validate([
            'nombre' => 'required',
            'cedula' => 'required',
            'provincia' => 'required',
            'canton' => 'required',
            'distrito' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'celular' => 'required',
            'correo' => 'required',
            'ocupacion' => 'required',
            'grado_academico' => 'required',
            'fecha_nacimiento' => 'required',
            'banco' => 'required',
            'num_cuenta_banco' => 'required',  
        ]);
  
        $product->update($request->all());
  
        return redirect()->route('trabajador.index')
                        ->with('success','trabajador updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\trabajador  $trabajador
     * @return \Illuminate\Http\Response
     */
    public function destroy(trabajador $trabajadortrabajador)
    {
        $trabajadortrabajador->delete();
  
        return redirect()->route('trabajador.index')
                        ->with('success','trabajador deleted successfully');
    }
}
