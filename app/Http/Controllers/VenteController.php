<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreVenteRequest;
use App\Services\FactureSchema;
use App\Shema;
use App\Vente;
use App\VenteItem;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ventes  = Vente::with('client')->get();
        if ($request->ajax()) {
            $data = Vente::with('client')->get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('vente.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteVente('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                return $btn;
            });
            $table->editColumn('', function ($row) {
                return null;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('reference', function($row){
                return $row->reference ? $row->reference : '';
            });
            $table->editColumn('client', function($row){
                return $row->client->nom ? $row->client->nom : '';
            });
            $table->editColumn('vente_date', function($row){
                return $row->vente_date ? $row->vente_date : '';
            });
            $table->editColumn('echeance_date', function($row){
                return $row->echeance_date ? $row->echeance_date : '';
            });
            $table->editColumn('created_by', function($row){
                return $row->created_by ? $row->created_by : '';
            });
            $table->editColumn('montant_ttc', function($row){
                return $row->montant_ttc ? $row->montant_ttc : '';
            });
            $table->editColumn('paiement_statut', function($row){
                return $row->paiement_statut ? Vente::PAY_STATUS_SELECT[$row->paiement_statut] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('vente.index',compact('ventes'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $shemas = Shema::where('type','vente')->get();
        return view('vente.create',compact('clients','shemas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVenteRequest $request)
    {
        $reference = FactureSchema::get_reference($request->shema_id);
        if(is_null($reference)){
            return back()->with('error', "Votre schema n'est pas valide");
        }
        $vente = new Vente();
        $vente->reference = $reference;
        $vente->paiement_statut = $request->paiement_statut;
        $vente->vente_date = $request->vente_date;
        $vente->echeance_date = $request->echeance_date;
        $vente->client_id = $request->client_id;
        $vente->created_by = auth()->user()->id;
        $vente->note = $request->note;
        $vente->montant_ht = $request->subTotal;
        $vente->tax = $request->taxTotal;
        $vente->montant_ttc = $request->grandTotal;
        $vente->shema_id = $request->shema_id;
        $vente->save();

        if($request->item_name){
            for ($i=0; $i < count($request->item_name) ; $i++) {
                $venteItem = new VenteItem();
                $venteItem->nom  =$request->item_name[$i];
                $venteItem->tax=$request->tax[$i];
                $venteItem->prix_unitaire=$request->price[$i];
                $venteItem->qte=$request->quantity[$i];
                $venteItem->montant_ht=$request->itemTotal[$i];
                $venteItem->description=$request->item_description[$i];
                $vente->venteitems()->save($venteItem);
            
                
            }
        }

        return redirect()->route('vente.index')->with('message','Vente est crée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function show(Vente $vente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function edit(Vente $vente)
    {
        $clients = Client::all();
        $shemas = Shema::where('type','vente')->get();
        $vente->load(['venteitems','client','schema']);
        return view('vente.edit',compact('clients','vente','shemas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVenteRequest $request, $id)
    {
        $vente = Vente::findOrFail($id);
        $venteShema = $vente->schema()->first();
        if($venteShema->id != $request->shema_id){
            $reference = FactureSchema::get_reference($request->shema_id);
            if(is_null($reference)){
                return back()->with('error', "Votre schema n'est pas valide");
            }
            $vente->reference = $reference;
        }

        $vente->paiement_statut = $request->paiement_statut;
        $vente->vente_date = $request->vente_date;
        $vente->echeance_date = $request->echeance_date;
        $vente->client_id = $request->client_id;
        $vente->created_by = auth()->user()->id;
        $vente->note = $request->note;
        $vente->montant_ht = $request->subTotal;
        $vente->tax = $request->taxTotal;
        $vente->montant_ttc = $request->grandTotal;
        $vente->shema_id = $request->shema_id;
        $vente->save();

        if($request->item_name){
            for ($i=0; $i < count($request->item_name) ; $i++) {
                if($request->item_id[$i]){
                    $venteItem = VenteItem::findOrFail($request->item_id[$i]);
                    $venteItem->nom  =$request->item_name[$i];
                    $venteItem->tax=$request->tax[$i];
                    $venteItem->prix_unitaire=$request->price[$i];
                    $venteItem->qte=$request->quantity[$i];
                    $venteItem->montant_ht=$request->itemTotal[$i];
                    $venteItem->description=$request->item_description[$i];
                    $vente->venteitems()->save($venteItem);
                }else{
                    $venteItem = new VenteItem();
                    $venteItem->nom  =$request->item_name[$i];
                    $venteItem->tax=$request->tax[$i];
                    $venteItem->prix_unitaire=$request->price[$i];
                    $venteItem->qte=$request->quantity[$i];
                    $venteItem->montant_ht=$request->itemTotal[$i];
                    $venteItem->description=$request->item_description[$i];
                    $vente->venteitems()->save($venteItem);
                }
                //$venteItem->fature_id=$vente->id;
                
            }
            VenteItem::whereNotIn('id',$request->item_id)->delete();
        }else{
            $vente->venteitems()->delete();
        }
        return back()->with('message','Vente est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vente $vente)
    {
        //
    }

    public function facturer_tous(Request $request){
        $ventes = Vente::whereIn('id',$request->ids)->get();
        $clients = $ventes->pluck('client_id')->toArray();
        $facturer = $ventes->where('facturer',1)->count();
        
        return response()->json([
            'message' => $clients,
            'error' => true
        ]);
    }
}
