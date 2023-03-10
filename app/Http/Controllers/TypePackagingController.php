<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypePackaging;
use App\TypePackaging;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypePackagingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TypePackaging::get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('TypePackaging.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteTypePackaging('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
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
        return view('packagingType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('packagingType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypePackaging $request)
    {
        TypePackaging::create($request->all());
        return redirect()->route('TypePackaging.index')->with('message','Ce Type est enregistr?? avec suc??es');
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
    public function edit(TypePackaging $TypePackaging)
    {
        return view('packagingType.edit',compact('TypePackaging'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypePackaging $TypePackaging)
    {
        $TypePackaging->update($request->all());
        return back()->with('message','Type est modifi?? avec succ??es');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($typePackaging)
    {
        $p = TypePackaging::findOrFail($typePackaging)->delete();
        if($p){
            return response()->json([
                'message' => 'Ce type de emballage est supprim?? avec succ??es',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs s'est pass??, refaire cette action apr??s",
                'success' => false
            ]);
        }
    }
}
