<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeFrais;
use App\TypeFrais;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeFraisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TypeFrais::get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('TypeFrais.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteTypeFrais('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
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
        return view('vehicleFrais.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicleFrais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeFrais $request)
    {
        TypeFrais::create($request->all());
        return redirect()->route('TypeFrais.index')->with('message','Type frais est crée avec sucées');
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
    public function edit(TypeFrais $TypeFrai)
    {
        return view('vehicleFrais.edit',compact('TypeFrai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTypeFrais $request, TypeFrais $TypeFrai)
    {
        $TypeFrai->update($request->all());
        return back()->with('message','Type Frais est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($typeFrais)
    {
        $v = TypeFrais::findOrFail($typeFrais)->delete();
        if($v){
            return response()->json([
                'message' => 'Ce type de Frais est supprimé avec succées',
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
