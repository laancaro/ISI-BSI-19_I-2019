<?php

  

namespace App\Http\Controllers;

  

use App\accessuser;

use Illuminate\Http\Request;

  

class accessuserController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $accessusers = accessuser::latest()->paginate(5);

  

        return view('accessusers.index',compact('accessusers'))

            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

   

    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        return view('accessusers.create');

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

            'user' => 'required',

            'rol' => 'required',

        ]);

  

        accessuser::create($request->all());

   

        return redirect()->route('accessusers.index')

                        ->with('success','accessuser created successfully.');

    }

   

    /**

     * Display the specified resource.

     *

     * @param  \App\accessuser  $accessuser

     * @return \Illuminate\Http\Response

     */

    public function show(accessuser $accessuser)

    {

        return view('accessusers.show',compact('accessuser'));

    }

   

    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\accessuser  $accessuser

     * @return \Illuminate\Http\Response

     */

    public function edit(accessuser $accessuser)

    {

        return view('accessusers.edit',compact('accessuser'));

    }

  

    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\accessuser  $accessuser

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, accessuser $accessuser)

    {

        $request->validate([

            'name' => 'required',

            'detail' => 'required',

        ]);

  

        $accessuser->update($request->all());

  

        return redirect()->route('accessusers.index')

                        ->with('success','accessuser updated successfully');

    }

  

    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\accessuser  $accessuser

     * @return \Illuminate\Http\Response

     */

    public function destroy(accessuser $accessuser)

    {

        $accessuser->delete();

  

        return redirect()->route('accessusers.index')

                        ->with('success','accessuser deleted successfully');

    }

}