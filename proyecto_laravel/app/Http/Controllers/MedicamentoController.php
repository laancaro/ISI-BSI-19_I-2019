<?php

namespace App\Http\Controllers;

use App\medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $medicamento = medicamento::latest()->paginate(5);
		
        return view('medicamento.index',compact('medicamento'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('medicamento.create');
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
            'descripcion' => 'required',
            'casa_farmaceutica' => 'required',
        ]);
        medicamento::create($request->all());
        return redirect()->route('medicamento.index')
                        ->with('success','medicamento created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(medicamento $medicamento)
    {
        return view('medicamento.show',compact('medicamento'));
    } 
    /**
     **Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function edit(medicamento $medicamento)
    {
        return view('medicamento.edit',compact('medicamento'));
    }
    /**
     * Update the specified resource in storage.
     *

     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, medicamento $medicamento)
    {
        $request->validate([            
            'nombre' => 'required',
            'descripcion' => 'required',
            'casa_farmaceutica' => 'required',
        ]);
        $medicamento->update($request->all());
        return redirect()->route('medicamento.index')
                        ->with('success','medicamento updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function destroy(medicamento $medicamento)
    {
        $medicamento->delete();
        return redirect()->route('medicamento.index')
                        ->with('success','medicamento deleted successfully');
    }
}