<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreClientRequest;
use App\TypeClient;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return Client::with('typeClient')->get();
        if ($request->ajax()) {
            $data = Client::with('typeClient')->get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('client.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteClient('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';

                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nom', function ($row) {
                return $row->nom ? $row->nom: '';
            });
            $table->editColumn('n_douane', function ($row) {
                return $row->n_douane ? $row->n_douane : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->typeClient ? $row->typeClient->name : '';
            });
            $table->editColumn('date_prem_relation', function ($row) {
                return $row->date_prem_relation ? $row->date_prem_relation : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('mobile_1', function ($row) {
                return $row->mobile_1 ? $row->mobile_1 : '';
            });
            $table->editColumn('mobile_2', function ($row) {
                return $row->mobile_2 ? $row->mobile_2 : '';
            });
            $table->editColumn('autre_info', function ($row) {
                return $row->autre_info ? $row->autre_info : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typesClient = TypeClient::where('active',1)->get();
        return view('client.create',compact('typesClient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        Client::create($request->all());
        return redirect()->route('client.index')->with('message','Client est ajoutée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $typesClient = TypeClient::where('active',1)->get();
        return view('client.edit',compact('client','typesClient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(StoreClientRequest $request, Client $client)
    {
        $client->update($request->all());
        return back()->with('message','Client est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $v = $client->delete();
        if($v){
            return response()->json([
                'message' => 'Client est supprimé avec succées',
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
