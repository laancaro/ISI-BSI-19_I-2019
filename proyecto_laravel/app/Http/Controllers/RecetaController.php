<?php

namespace App\Http\Controllers;

use App\receta;
use Illuminate\Http\Request;

class recetaController extends Controller

{
    public function index()
    {
        $receta = receta::latest()->paginate(5);
        return view('receta.index',compact('receta'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
       return view('receta.create');
    }
	
    public function store(Request $request)
    {
       $request->validate([
            /*
			*'id' => 'required',
			*/
            'persona' => 'required',
            'medicamento' => 'required',
            'cantidad' => 'required',
            'usuario' => 'required',
            'fecha_entrega' => 'required',
        ]);

        receta::create($request->all());

        return redirect()->route('receta.index')
                        ->with('success','receta created successfully.');
    }

    public function show(receta $receta)
    {
        return view('receta.show',compact('receta'));
    }

    public function edit(receta $receta)
    {
        return view('receta.edit',compact('receta'));
    }

    public function update(Request $request, receta $receta)
    {
        $request->validate([
            /*
			*'id' => 'required',
			*/
            'persona' => 'required',
            'medicamento' => 'required',
            'cantidad' => 'required',
            'usuario' => 'required',
            'fecha_entrega' => 'required',
        ]);

        $receta->update($request->all());
        return redirect()->route('receta.index')
                        ->with('success','receta updated successfully');
    }

    public function destroy(receta $receta)
    {
        $receta->delete();
        return redirect()->route('receta.index')
                        ->with('success','receta deleted successfully');
    }
}