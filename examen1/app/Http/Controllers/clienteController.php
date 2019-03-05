<?php
  
namespace App\Http\Controllers;
  
use App\cliente;
use Illuminate\Http\Request;
  
class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = cliente::latest()->paginate(5);
  
        return view('cliente.index',compact('cliente'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
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
            'tipo' => 'required',
            'identificacion' => 'required',
            'direccion' => 'required',
            'contacto' => 'required',
            'telefono' => 'required',
            'correo' => 'required'
        ]);
  
        cliente::create($request->all());
   
        return redirect()->route('cliente.index')
                        ->with('success','cliente created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(cliente $cliente)
    {
        return view('cliente.show',compact('cliente'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(cliente $cliente)
    {
        return view('cliente.edit',compact('cliente'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cliente $cliente)
    {
        $request->validate([
           'nombre' => 'required',
            'tipo' => 'required',
            'identificacion' => 'required',
            'direccion' => 'required',
            'contacto' => 'required',
            'telefono' => 'required',
            'correo' => 'required'
        ]);
  
        $cliente->update($request->all());
  
        return redirect()->route('cliente.index')
                        ->with('success','cliente updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(cliente $cliente)
    {
        $cliente->delete();
  
        return redirect()->route('cliente.index')
                        ->with('success','cliente deleted successfully');
    }
}