<?php

namespace App\Http\Controllers;

use App\Exports\PlomosExport;
use App\Http\Requests\StorePlomoRequest;
use App\Plomo;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

class PlomoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
               if ($request->ajax()) {
            $data = Plomo::all()->unique('num_serie');

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $btn = "";
                $editLink = route('plomos.edit',$row->id);
                //$btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deletePlomo('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                $btn .= '<button type="button" data-toggle="modal" data-target=".modalSortant" onclick="sortantPlomos('.$row->id.')" class="btn btn-primary btn-sm mr-1">Sortant</button>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('num_serie', function($row){
                return $row->num_serie ? $row->num_serie : '';
            });
            $table->editColumn('utilisation', function($row){
                if($row->used_at){
                    if($row->havePlomos_type == 'App\Dossier'){
                        return "Dossier";
                    }else{
                        return "Magasinage";
                    }
                }else{
                    return "";
                }
            });
            $table->editColumn('traiter_de', function($row){
                return $row->traiter_de ? $row->traiter_de : '';
            });
            $table->editColumn('traiter_a', function($row){
                return $row->traiter_a ? $row->traiter_a : '';
            });
            $table->editColumn('defaillante', function($row){
                if($row->defaillante == 1)
                return '<i class="dripicons-wrong"></i>';
                return '<i class="dripicons-checkmark"></i>';

            });

            $table->rawColumns(['defaillante','actions', 'placeholder']);

            return $table->make(true);
        }
        return view('plomos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plomos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type == '0'){
        $from = (int) $request->from;
        $to = (int) $request->to;


        if($to < $from ){
            return back()->with('error','Fin série doit étre égale ou supérieur de debut de série');
        }

        if(($to - $from) > 200 ){
            return back()->with('error','La série ne doit pas dépasser 200');
        }

        for ($i=$from; $i <= $to ; $i++) {
            Plomo::create([
                'num_serie' => '0'.$i,
                'traiter_de' => 'douane',
            ]);
        }

        }else{
            Plomo::create([
                'num_serie' => $request->num_serie,
                'traiter_de' => $request->traiter_de,
            ]);
        }
        return redirect()->route('plomos.index')->with('message','Plomos Ajoutée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plomo  $plomo
     * @return \Illuminate\Http\Response
     */
    public function show(Plomo $plomo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plomo  $plomo
     * @return \Illuminate\Http\Response
     */
    public function edit(Plomo $plomo)
    {
        return view('plomos.edit',compact('plomo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plomo  $plomo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plomo $plomo)
    {
        $defaillante = 0;
        if($request->defaillante == 'on'){
            $defaillante = 1;
        }

        $plomo->update([
            'traiter_de' => $request->traiter_de,
            'traiter_a' => $request->traiter_a,
            'defaillante' => $defaillante,
        ]);
        return back()->with('message','Scelle douane est modifié avec succées');
    }

    public function sortant($id,Request $request){
        $plomo = Plomo::findOrFail($id);
        if($request->type == '0'){
            $plomo->update([
                'traiter_a' => null,
                'defaillante' => 1,
            ]);
        }else{
            $plomo->update([
                'defaillante' => 0,
                'traiter_a' => $request->traiter_a,
            ]);
        }
        return response()->json([
            'data' => 'Succes',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plomo  $plomo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plomo $plomo)
    {
        $v = $plomo->delete();

        if($v){
            return response()->json([
                'message' => 'Station est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs, refaire cette action aprés",
                'success' => false
            ]);
        }
    }

    public function rapport(){
        return Excel::download(new PlomosExport, 'plomos.xlsx');
    }
}
