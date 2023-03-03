<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStationsRequest;
use App\Station;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Station::get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('station.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteStation('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nom', function ($row) {
                return $row->nom ? $row->nom : '';
            });
            $table->editColumn('ville', function ($row) {
                return $row->ville ? $row->ville : '';
            });
            $table->editColumn('adress', function($row){
                return $row->adress ? $row->adress : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('station.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('station.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStationsRequest $request)
    {
        Station::create($request->all());
        return redirect()->route('station.index')->with('message','Station ajouté avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function edit(Station $station)
    {
        return view('station.edit',compact('station')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStationsRequest $request, Station $station)
    {
        $station->update($request->all());
        return back()->with('message','Station est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Station  $station
     * @return \Illuminate\Http\Response
     */
    public function destroy(Station $station)
    {
        $v = $station->delete();
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
}
