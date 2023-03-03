<?php

namespace App\Http\Controllers;

use App\GeneralFrais;
use App\TypeFrais;
use Illuminate\Http\Request;

class GeneralFraisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $freeTypeFrais = TypeFrais::where('active',1)->get();
        $marocFrais = GeneralFrais::where('type_frais','maroc')->first();
        $etrangerFrais = GeneralFrais::where('type_frais','etranger')->first();
        $generalMarocFrais = $marocFrais; 
        $generalEtrangerFrais =  $etrangerFrais;
        return view('GeneralFrais.index',compact('freeTypeFrais','generalMarocFrais','generalEtrangerFrais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $generalMarocFrais = GeneralFrais::where('type_frais','maroc')->first();
        $generalEtrangerFrais = GeneralFrais::where('type_frais','etranger')->first();

        TypeFrais::where('id',$request->fraisMaroc)->update(['general_frais_id' => $generalMarocFrais->id]);
        TypeFrais::where('id',$request->fraisEtranger)->update(['general_frais_id' => $generalEtrangerFrais->id]);

        // $generalMarocFrais->Type_Frais()->sync($fraisMaroc);
        // $generalEtrangerFrais->Type_Frais()->sync($fraisEtranger);
        // // for ($i=0; $i < count($fraisMaroc) ; $i++) { 
        // //     TypeFrais::where('id',$fraisMaroc[$i])->update(['general_frais_id' => $generalMarocFrais->id]);
        // // }

        // // for ($i=0; $i < count($fraisEtranger) ; $i++) { 
        // //     TypeFrais::where('id',$fraisEtranger[$i])->update(['general_frais_id' => $generalEtrangerFrais->id]);
        // // }

        return back()->with('message','affectation faite avec succées');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GeneralFrais  $generalFrais
     * @return \Illuminate\Http\Response
     */
    public function show(GeneralFrais $generalFrais)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GeneralFrais  $generalFrais
     * @return \Illuminate\Http\Response
     */
    public function edit(GeneralFrais $generalFrais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GeneralFrais  $generalFrais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GeneralFrais $generalFrais)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GeneralFrais  $generalFrais
     * @return \Illuminate\Http\Response
     */
    public function destroy(GeneralFrais $generalFrais)
    {
        //
    }
}
