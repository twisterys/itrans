<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeVehicle;
use App\TypeVehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TypeVehicle::get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('TypeVehicle.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteTypeVehicle('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';

                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('active', function ($row) {
                if($row->active)
                return '<i class="dripicons-checkmark"></i>';
                return '<i class="dripicons-wrong"></i>';
            });

            $table->rawColumns(['active','actions', 'placeholder']);

            return $table->make(true);
        }
        return view('vehicleType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicleType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeVehicle $request)
    {
        TypeVehicle::create($request->all());
        return redirect()->route('TypeVehicle.index')->with('message','Ce Type est enregistré avec sucées');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeVehicle $TypeVehicle)
    {
        return view('vehicleType.edit',compact('TypeVehicle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeVehicle $TypeVehicle)
    {
        $TypeVehicle->update($request->all());
        return back()->with('message','Type est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($typeVehicle)
    {
        $v = TypeVehicle::findOrFail($typeVehicle)->delete();
        if($v){
            return response()->json([
                'message' => 'Ce type de Vehicule est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs s'est passé, refaire cette action aprés",
                'success' => false
            ]);
        }
    }
}
