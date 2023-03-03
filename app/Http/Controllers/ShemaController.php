<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShemaRequest;
use App\Services\FactureSchema;
use App\Shema;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ShemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Shema::all();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('shema.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteShema('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nom', function($row){
                return $row->nom ? $row->nom : '';
            });
            $table->editColumn('start_from', function($row){
                return $row->start_from ? $row->start_from : '';
            });
            $table->editColumn('prefix', function($row){
                return $row->prefix ? $row->prefix : '';
            });
            $table->editColumn('suffix', function($row){
                return $row->suffix ? $row->suffix : '';
            });
            $table->editColumn('letterscount', function($row){
                return $row->letterscount ? $row->letterscount : '';
            });
            $table->editColumn('current', function($row){
                return $row->current ? $row->current : '';
            });
            $table->editColumn('date', function($row){
                return $row->date ? $row->date : '';
            });
            $table->editColumn('type', function($row){
                return $row->type ? Shema::TYPE_SELECT[$row->type] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('shema.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shema.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShemaRequest $request)
    {
        Shema::create($request->all());
        return redirect()->route('shema.index')->with('message','Schéma est crée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shema  $shema
     * @return \Illuminate\Http\Response
     */
    public function show(Shema $shema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shema  $shema
     * @return \Illuminate\Http\Response
     */
    public function edit(Shema $shema)
    {
        return view('shema.edit',compact('shema'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Shema  $shema
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShemaRequest $request, Shema $shema)
    {
        $shema->update($request->all());
        return redirect()->route('shema.index')->with('message','Schéma est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shema  $shema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shema $shema)
    {
        //
    }
}
