<?php
  
namespace App\Http\Controllers;
  
use App\factura;
use App\cliente;
use Illuminate\Http\Request;
  
class facturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factura = factura::latest()->paginate(5);
  
        return view('factura.index',compact('factura'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( )
    {

        $clientes = \DB::table('cliente')->pluck('nombre', 'id');
        $productos = \DB::table('producto')->pluck('nombre', 'id');
      
        return view('factura.create')->with(['clientes'=>$clientes,'productos'=>$productos]);
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
            'fecha' => 'required',
            'moneda' => 'required',
            'tipo_cambio' => 'required',
            'cliente' => 'required',
            'producto1' => 'required',
            'producto2' => 'required',
            'producto3' => 'required',
            'subtotal' => 'required',
            'descuento' => 'required',
            'impuestos' => 'required',
            'total' => 'required',
        ]);
  
        factura::create($request->all());
   
        return redirect()->route('factura.index')
                        ->with('success','factura created successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(factura $factura)
    {
        return view('factura.show',compact('factura'));
    }
   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(factura $factura)
    {
        return view('factura.edit',compact('factura'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, factura $factura)
    {
        $request->validate([           
            'fecha' => 'required',
            'moneda' => 'required',
            'tipo_cambio' => 'required',
            'cliente' => 'required',
            'producto1' => 'required',
            'producto2' => 'required',
            'producto3' => 'required',
            'subtotal' => 'required',
            'descuento' => 'required',
            'impuestos' => 'required',
            'total' => 'required',
        ]);
  
        $factura->update($request->all());
  
        return redirect()->route('factura.index')
                        ->with('success','factura updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(factura $factura)
    {
        $factura->delete();
  
        return redirect()->route('factura.index')
                        ->with('success','factura deleted successfully');
    }
}