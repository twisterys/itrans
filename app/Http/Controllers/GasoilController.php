<?php

namespace App\Http\Controllers;

use App\Gasoil;
use App\Http\Requests\StoreGasoilRequest;
use App\Person;
use App\Station;
use App\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GasoilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Gasoil::class);
        //return Gasoil::with(['station:id,nom,ville','chauffeur:id,nom,prenom,cin'])->get();
        if ($request->ajax()) {
            $data = Gasoil::with(['station:id,nom,ville','chauffeur:id,nom,prenom,cin'])->get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('gasoil.edit',$row->id);
                $deleteLink = 'deleteGasoil('.$row->id.')';
                return view('partials.gasoilActions',compact('editLink','deleteLink'));


                //$btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                //$btn .= '<button onclick="deleteGasoil('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                //return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : '';
            });
            $table->editColumn('station', function ($row) {
                return $row->station ? $row->station->nom.'('.$row->station->ville.')' : '';
            });
            $table->editColumn('kilometrage', function ($row) {
                return $row->kilometrage ? $row->kilometrage : '';
            });
            $table->editColumn('chauffeur', function ($row) {
                return $row->chauffeur ? $row->chauffeur->nom.' '.$row->chauffeur->prenom.'('.$row->chauffeur->cin.')' : '';
            });
            $table->editColumn('matricule', function ($row) {
                return $row->vehicle ? $row->vehicle : '';
            });
            $table->editColumn('prix', function ($row) {
                return $row->prix ? $row->prix : '';
            });
            $table->editColumn('qte', function ($row) {
                return $row->qte ? $row->qte : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('gasoil.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Gasoil::class);
        $stations = Station::get(['id','nom','ville']);
        $vehicles = Vehicle::pluck('N_immatriculation');
        $drivers = Person::where('fonction','chauffeur')->get(['id','nom','prenom','cin']);
        return view('gasoil.create',compact('stations','vehicles','drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGasoilRequest $request)
    {
        $this->authorize('create',Gasoil::class);
        $gasoil = new Gasoil();
        $gasoil->date = $request->date;
        $gasoil->station_id = $request->station;
        $gasoil->kilometrage = $request->kilometrage;
        $gasoil->chauffeur_id = $request->chauffeur;
        $gasoil->vehicle = $request->vehicle;
        $gasoil->prix = $request->prix;
        $gasoil->qte = $request->qte;  
        $gasoil->save();
        return redirect()->route('gasoil.index')->with('message','Gasoil est crée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gasoil  $gasoil
     * @return \Illuminate\Http\Response
     */
    public function show(Gasoil $gasoil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gasoil  $gasoil
     * @return \Illuminate\Http\Response
     */
    public function edit(Gasoil $gasoil)
    {
        $this->authorize('update',Gasoil::class);
        $stations = Station::get(['id','nom','ville']);
        $vehicles = Vehicle::pluck('N_immatriculation');
        $drivers = Person::where('fonction','chauffeur')->get(['id','nom','prenom','cin']);
        $gasoil->load(['station','chauffeur']);
        return view('gasoil.edit',compact('gasoil','stations','vehicles','drivers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gasoil  $gasoil
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGasoilRequest $request, Gasoil $gasoil)
    {
        $this->authorize('update',Gasoil::class);
        $gasoil->date = $request->date;
        $gasoil->station_id = $request->station;
        $gasoil->kilometrage = $request->kilometrage;
        $gasoil->chauffeur_id = $request->chauffeur;
        $gasoil->vehicle = $request->vehicle;
        $gasoil->prix = $request->prix;
        $gasoil->qte = $request->qte;  
        $gasoil->save();

        return back()->with('message','Gasoil est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gasoil  $gasoil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gasoil $gasoil)
    {
        $this->authorize('delete',Gasoil::class);
        $v = $gasoil->delete();
        if($v){
            return response()->json([
                'message' => 'Gasoil est supprimé avec succées',
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
