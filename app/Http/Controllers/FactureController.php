<?php

namespace App\Http\Controllers;

use App\Client;
use App\Facture;
use App\FactureItem;
use App\Http\Requests\StoreFactureRequest;
use App\Services\FactureSchema;
use App\Shema;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Facture::with('client')->get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $editLink = route('facture.edit',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteFacture('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                return $btn;
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
            $table->editColumn('facture_date', function($row){
                return $row->facture_date ? $row->facture_date : '';
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
                return $row->paiement_statut ? Facture::PAY_STATUS_SELECT[$row->paiement_statut] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('facture.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $shemas = Shema::where('type','facture')->get();
        return view('facture.create',compact('clients','shemas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFactureRequest $request)
    {
        //return $request->all();
        $reference = FactureSchema::get_reference($request->shema_id);
        if(is_null($reference)){
            return back()->with('error', "Votre schema n'est pas valide");
        }

        $facture = new Facture();
        $facture->reference = $reference;
        $facture->paiement_statut = $request->paiement_statut;
        $facture->facture_date = $request->facture_date;
        $facture->echeance_date = $request->echeance_date;
        $facture->client_id = $request->client_id;
        $facture->created_by = auth()->user()->id;
        $facture->note = $request->note;
        $facture->montant_ht = $request->subTotal;
        $facture->tax = $request->taxTotal;
        $facture->montant_ttc = $request->grandTotal;
        $facture->shema_id = $request->shema_id;
        $facture->save();

        if($request->item_name){
            for ($i=0; $i < count($request->item_name) ; $i++) {
                $factureItem = new FactureItem();
                $factureItem->nom  =$request->item_name[$i];
                $factureItem->tax=$request->tax[$i];
                $factureItem->prix_unitaire=$request->price[$i];
                $factureItem->qte=$request->quantity[$i];
                $factureItem->montant_ht=$request->itemTotal[$i];
                $factureItem->description=$request->item_description[$i];
                $facture->factureitems()->save($factureItem);
                //$factureItem->fature_id=$facture->id;
                
            }
        }

        return back()->with('message','Facture est crée avec succées');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function show(Facture $facture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function edit(Facture $facture)
    {
        $clients = Client::all();
        $shemas = Shema::where('type','facture')->get();
        $facture->load(['factureitems','client','schema']);
        return view('facture.edit',compact('clients','facture','shemas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFactureRequest $request, $id)
    {
        $facture = Facture::findOrFail($id);
        
        $factureShema = $facture->schema()->first();
        if($factureShema->id != $request->shema_id){
            $reference = FactureSchema::get_reference($request->shema_id);
            if(is_null($reference)){
                return back()->with('error', "Votre schema n'est pas valide");
            }
            $facture->reference = $reference;
        }
        
        $facture->paiement_statut = $request->paiement_statut;
        $facture->facture_date = $request->facture_date;
        $facture->echeance_date = $request->echeance_date;
        $facture->client_id = $request->client_id;
        $facture->created_by = auth()->user()->id;
        $facture->note = $request->note;
        $facture->montant_ht = $request->subTotal;
        $facture->tax = $request->taxTotal;
        $facture->montant_ttc = $request->grandTotal;
        $facture->shema_id = $request->shema_id;
        $facture->save();

        if($request->item_name){
            for ($i=0; $i < count($request->item_name) ; $i++) {
                if($request->item_id[$i]){
                    $factureItem = FactureItem::findOrFail($request->item_id[$i]);
                    $factureItem->nom  =$request->item_name[$i];
                    $factureItem->tax=$request->tax[$i];
                    $factureItem->prix_unitaire=$request->price[$i];
                    $factureItem->qte=$request->quantity[$i];
                    $factureItem->montant_ht=$request->itemTotal[$i];
                    $factureItem->description=$request->item_description[$i];
                    $facture->factureitems()->save($factureItem);
                }else{
                    $factureItem = new FactureItem();
                    $factureItem->nom  =$request->item_name[$i];
                    $factureItem->tax=$request->tax[$i];
                    $factureItem->prix_unitaire=$request->price[$i];
                    $factureItem->qte=$request->quantity[$i];
                    $factureItem->montant_ht=$request->itemTotal[$i];
                    $factureItem->description=$request->item_description[$i];
                    $facture->factureitems()->save($factureItem);
                }
                //$factureItem->fature_id=$facture->id;
                
            }
            FactureItem::whereNotIn('id',$request->item_id)->delete();
        }else{
            $facture->factureitems()->delete();
        }
        return back()->with('message','facture est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facture  $facture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        //
    }
}
