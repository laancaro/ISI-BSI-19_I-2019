<?php

namespace App\Http\Controllers;

use App\persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $persona = persona::latest()->paginate(5);
  
        return view('persona.index',compact('persona'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persona.create');
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
            'cedula' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required',
        ]);
  
        persona::create($request->all());
   
        return redirect()->route('persona.index')
                        ->with('success','Persona created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(persona $persona)
    {
        return view('persona.show',compact('persona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(persona $persona)
    {
        return view('persona.edit',compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, persona $persona)
    {
        $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required',
        ]);

   $persona->update($request->all());
  
        return redirect()->route('persona.index')
                        ->with('success','Persona updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(persona $persona)
    {
        $persona->delete();
  
        return redirect()->route('persona.index')
                        ->with('success','persona deleted successfully');
    }
}
