<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransitaireRequest;
use App\Transitaire;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TransitaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transitaire::get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('transitaire.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteTransitaire('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nom', function ($row) {
                return $row->nom ? $row->nom : '';
            });
            $table->editColumn('ice', function ($row) {
                return $row->ice ? $row->ice : '';
            });
            $table->editColumn('numero', function ($row) {
                return $row->numero ? $row->numero : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('adress', function ($row) {
                return $row->adress ? $row->adress : '';
            });
            

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('transitaire.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transitaire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransitaireRequest $request)
    {
        Transitaire::create($request->all());
        return redirect()->route('transitaire.index')->with('message','Transitaire est crée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transitaire  $transitaire
     * @return \Illuminate\Http\Response
     */
    public function show(Transitaire $transitaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transitaire  $transitaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Transitaire $transitaire)
    {
        return view('transitaire.edit',compact('transitaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transitaire  $transitaire
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTransitaireRequest $request, Transitaire $transitaire)
    {
        $transitaire->update($request->all());
        return back()->with('message','Transitaire est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transitaire  $transitaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transitaire $transitaire)
    {
        $v = $transitaire->delete();
        if($v){
            return response()->json([
                'message' => 'Transitaire est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs, refaire cette action aprés",
                'success' => false
            ]);
        }
    }
}
