<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateParametrageRequest;
use App\Parametrage;
use Illuminate\Http\Request;

class ParametrageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Parametrage  $parametrage
     * @return \Illuminate\Http\Response
     */
    public function show(Parametrage $parametrage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Parametrage  $parametrage
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $parametrage = Parametrage::first();

        return view('parametrage.parametrage',compact('parametrage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Parametrage  $parametrage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParametrageRequest $request, Parametrage $parametrage)
    {
         $parametrage->update($request->all());
         return back()->with('message',"Paramétrage d'expiration est modifié avec succées");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Parametrage  $parametrage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parametrage $parametrage)
    {
        //
    }
}
