<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeClientRequest;
use App\TypeClient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TypeClient::get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('TypeClient.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteTypeClient('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';

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
        return view('clientType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeClientRequest $request)
    {
        TypeClient::create($request->all());
        return redirect()->route('TypeClient.index')->with('message','Type client est ajoutée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TypeClient $TypeClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeClient $TypeClient)
    {
        return view('clientType.edit',compact('TypeClient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTypeClientRequest $request, TypeClient $TypeClient)
    {
        $TypeClient->update($request->all());
        return back()->with('message','Type client est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($TypeClient)
    {
        $v = TypeClient::findOrFail($TypeClient)->delete();
        if($v){
            return response()->json([
                'message' => 'Ce type de Client est supprimé avec succées',
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
