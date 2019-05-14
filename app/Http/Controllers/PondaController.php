<?php

namespace App\Http\Controllers;

use App\Models\Ponda;
use Illuminate\Http\Request;

class PondaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pondas = Ponda::all();

        return view('ponda.index', compact('pondas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ponda.create');
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
            'name'=>'required|string|min:1',
            'introduction'=>'required|string|min:1'  
        ]);
        $ponda = new Ponda;
        $ponda->name = $request->name;
        $ponda->introduction = $request->introduction;
        $ponda->score = $request->score;

        $ponda->save();

        return redirect()->route('ponda.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ponda  $ponda
     * @return \Illuminate\Http\Response
     */
    public function show(Ponda $ponda)
    {
        $ponda->score = $ponda->score +1;

        $ponda->save();

        return redirect('/ponda');
        // dd($ponda);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ponda  $ponda
     * @return \Illuminate\Http\Response
     */
    public function edit(Ponda $ponda)
    {
        return view('ponda.edit', compact('ponda'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ponda  $ponda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ponda $ponda)
    {
        

        $ponda->name = request('name');
        $ponda->introduction = request('introduction');

        $ponda->save();

        return redirect('/ponda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ponda  $ponda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ponda $ponda)
    {
        $ponda->delete();
    }

    public function SUB()
    {
        dd('dd');
    }


   

  
}
