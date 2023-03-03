<?php

namespace App\Http\Controllers;

use App\Client;
use App\Dossier;
use App\DossierItem;
use App\DossierPlomos;
use App\DossierVehicles;
use App\Export;
use App\ExportItem;
use App\Http\Requests\ExportStoreRequest;
use App\MagasinagePlomos;
use App\Person;
use App\PersonalExpense;
use App\Plomo;
use App\Transitaire;
use App\TypeFrais;
use App\TypeVehicle;
use App\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExportController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Dossier::class);
        if ($request->ajax()) {
            $data = Dossier::where('type','export')->with(['media','dossierItems' => function($q){
                $q->with('client');
            },'dossierVehicles' => function($q){
                $q->with('vehicles');
            }])->get();


            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $showLink = route('export.show',$row->id);
                $editLink = route('export.edit',$row->id);
                $deleteLink = 'deleteExport('.$row->id.')';
                $docsLink = route('export.documents',$row->id);
                $downloadLink = route('import.download',$row->id);
                return view('partials.exportActions',compact('showLink','editLink','deleteLink','docsLink','downloadLink'));


                //$btn = '<a href="'.$showLink.'" class="btn btn-info btn-sm mr-1">Afficher</a>';
                //$btn .= '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                //$btn .= '<button type="button" class="btn btn-danger btn-sm mr-1" onclick="deleteExport('.$row->id.')">Supprimer</button>';
                //$btn .= '<a href="'.$docsLink.'" class="btn btn-secondary btn-sm mr-1">Documents</a>';
                //return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : '';
            });
            $table->editColumn('driver', function ($row) {
                $chauffeur = '';
                foreach ($row->chauffeur as $ch) {
                    $chauffeur .= '<span class="badge bg-info text-white">'.$ch->nom.' '.$ch->prenom.'</span>';
                }
                return $chauffeur ? $chauffeur : '';
            });
            $table->editColumn('provenance', function ($row) {
                return $row->provenance ? $row->provenance : '';
            });
            $table->editColumn('destination', function ($row) {
                return $row->destination ? $row->destination : '';
            });
            $table->editColumn('date_arrive', function ($row) {
                return $row->date_arrive ? $row->date_arrive : '';
            });
            $table->editColumn('date_sortie', function ($row) {
                return $row->date_sortie ? $row->date_sortie : '';
            });

            $table->editColumn('client', function ($row) {
                if($row->type_chargement == 'groupage'){
                    return 'Groupage';
                }else{
                    foreach ($row->dossierItems as $item) {
                        return $item->client ? $item->client->nom : '';
                    }
                }
            });

            $table->addColumn('vehicule', function ($row) {
                $html='';
                foreach($row->dossierVehicles as $vehicule)
                {
                    $html.= '<span class="badge bg-info text-white mr-1">'.($vehicule->vehicle_id ? $vehicule->vehicles->N_immatriculation : $vehicule->matricule).'</span>';
                }
                return $html ;

            });


            $table->rawColumns(['driver','vehicule','actions', 'placeholder']);

            return $table->make(true);
        }


        return view('exportss.index');
    }

    public function show(Request $request,Dossier $export){
        $this->authorize('view',Dossier::class);
        $export->load(['personalExpenses','dossierItems','dossierVehicles','plomos','chauffeur']);
        $export->dossierVehicles->load(['vehicles','TypeVehicle']);
        $export->personalExpenses->load('TypeFrais');
        $export->dossierItems->load('client');

        return view('exportss.show',compact('export'));
    }

    public function create(){
        $this->authorize('create',Dossier::class);

        //$plomoMagasinage = MagasinagePlomos::pluck('num_serie');
        //$AllDossierPlomos = DossierPlomos::pluck('num_serie');
        $plomos = Plomo::where('used_at',null)->where('defaillante',0)->where('traiter_a',NULL)->get();

        $clients = Client::all();
        $transitaires = Transitaire::all();
        $chauffeurs = Person::where('fonction','chauffeur')->get();

        $vehicles = Vehicle::pluck('N_immatriculation');
        $typeVehicle = TypeVehicle::where('active',1)->get();
        $typeFrais = TypeFrais::where('active',1)->get();
        $drivers = Person::where('fonction','chauffeur')->get(['nom','prenom','cin']);
        return view('exportss.create',compact('vehicles','typeVehicle','typeFrais','drivers','plomos','clients','transitaires','chauffeurs'));
    }


    /**
     * @param \App\Http\Requests\ExportStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExportStoreRequest $request)
    {
        $this->authorize('update',Dossier::class);
        $import = Dossier::create($request->all());
        $import->type='export';
        $import->save();

        if($request->chauffeurs){
            $import->chauffeur()->sync($request->chauffeurs);
        }

        if($request->plomos){
            foreach ($request->plomos as $plomo) {
                $plomos = Plomo::findOrFail($plomo);
                $plomos->update([
                     'used_at' => Carbon::now(),
                     'havePlomos_type' => 'App\Dossier',
                     'havePlomos_id' => $import->id
                ]);
            }
        }

        if($request->type_vehicle && $request->matriculeVehicle){

            $typeVehicles = $request->type_vehicle;
            $matricules = $request->matriculeVehicle;

            for ($i=0; $i <count($typeVehicles) ; $i++) {
                $importVehicle = new DossierVehicles();
                $importVehicle->typeVehicle_id = $typeVehicles[$i];

                if(Vehicle::where('N_immatriculation',$matricules[$i])->exists()){
                    $vehicle = Vehicle::where('N_immatriculation',$matricules[$i])->first();
                    $importVehicle->vehicle_id = $vehicle->id;

                }else{
                    $importVehicle->matricule = $matricules[$i];

                }

                $import->dossierVehicles()->save($importVehicle);
            }
        }

        if($request->importItems){
            $importIt =  json_decode($request->importItems);
            foreach ($importIt as $value) {
                $importItem = new DossierItem();
                $importItem->client_id = $value->client;
                $importItem->importateur = $value->importateur;
                $importItem->exportateur = $value->exportateur;
                if($value->transitaire != 'Open this select menu'){
                    $importItem->transitaire_id = $value->transitaire;
                }
                $importItem->marchandise = $value->marchandise;
                $importItem->dum = $value->dum;
                $importItem->numb_colis = $value->numb_colis;
                $importItem->poid_brute = $value->poid_brute;
                $importItem->observ = $value->observ;
                $import->dossierItems()->save($importItem);
            }
        }
        if($request->type_frais && $request->montant && $request->devise){
            $type_frais = $request->type_frais;
            $montant = $request->montant;
            $devise = $request->devise;
            for ($i=0; $i < count($type_frais) ; $i++) {
                $p = new PersonalExpense();
                $p->typeFrais_id = $type_frais[$i];
                $p->montant = $montant[$i];
                $p->devise = $devise[$i];
                $import->personalExpenses()->save($p);
            }
        }
        return redirect()->route('export.index')->with('message','Export est crée avec succés');
    }



    public function edit(Dossier $export){
        $this->authorize('update',Dossier::class);

        $plomosNotUsed = Plomo::where('used_at',null)->where('defaillante',0)->where('traiter_a',NULL)->get();


        $export->load(['dossierVehicles','dossierItems','personalExpenses','plomos'])->where('type','export');
        $export->dossierVehicles->load('vehicles');
        $export->personalExpenses->load('TypeFrais');
        $export->dossierItems->load(['client','transitaire']);

        $dossierPlomos = $export->plomos()->get();
        $plomos = $dossierPlomos->merge($plomosNotUsed);

        $clients = Client::all();
        $transitaires = Transitaire::all();
        $chauffeurs = Person::where('fonction','chauffeur')->get();


        $typeVehicle = TypeVehicle::where('active',1)->get();
        $typeFrais = TypeFrais::where('active',1)->get();
        $vehicles = Vehicle::pluck('N_immatriculation');
        $drivers = Person::where('fonction','chauffeur')->get(['nom','prenom','cin']);
        return view('exportss.edit',compact('export','vehicles','typeVehicle','typeFrais','drivers','plomos','clients','transitaires','chauffeurs'));
    }

    public function update(ExportStoreRequest $request,Dossier $export){
        $this->authorize('update',Dossier::class);

        $idImpItems = array();
        $idVehicles = array();
        $idFraisPerso = array();
        $export->update($request->all());

        if($request->chauffeurs){
            $export->chauffeur()->sync($request->chauffeurs);
        }else{
            $export->chauffeur()->sync(null);
        }

        if($request->plomos){
            foreach ($request->plomos as $plomo) {

                if(!$export->plomos->contains($plomo)){
                    $plomos = Plomo::findOrFail($plomo);
                    $plomos->update([
                        'used_at' => Carbon::now(),
                        'havePlomos_type' => 'App\Dossier',
                        'havePlomos_id' => $export->id
                ]);

                }
            }
            $export->plomos()->whereNotIn('id',$request->plomos)->update([
                'used_at' => null,
                'havePlomos_type' => null,
                'havePlomos_id' => null
            ]);

        }else{
            $export->plomos()->update([
                'used_at' => null,
                'havePlomos_type' => null,
                'havePlomos_id' => null
            ]);
        }




        if($request->type_vehicle && $request->matriculeVehicle ){

            $idVehicle = $request->IdVehicle;
            $typeVehicles = $request->type_vehicle;
            $matricules = $request->matriculeVehicle;

            for ($i=0; $i <count($typeVehicles) ; $i++) {
                if($idVehicle[$i]){
                    array_push($idVehicles,$idVehicle[$i]);
                    $importVehicle = DossierVehicles::find($idVehicle[$i]);
                    $importVehicle->typeVehicle_id = $typeVehicles[$i];

                    if(Vehicle::where('N_immatriculation',$matricules[$i])->exists()){
                        $vehicle = Vehicle::where('N_immatriculation',$matricules[$i])->first();
                        $importVehicle->vehicle_id = $vehicle->id;
                        $importVehicle->matricule = null;
                    }else{
                        $importVehicle->matricule = $matricules[$i];
                        $importVehicle->vehicle_id = null;
                    }

                    $export->dossierVehicles()->save($importVehicle);
                }else{
                    $importVehicle = new DossierVehicles();
                    $importVehicle->typeVehicle_id = $typeVehicles[$i];

                    if(Vehicle::where('N_immatriculation',$matricules[$i])->exists()){
                        $vehicle = Vehicle::where('N_immatriculation',$matricules[$i])->first();
                        $importVehicle->vehicle_id = $vehicle->id;
                        $importVehicle->matricule = null;
                    }else{
                        $importVehicle->matricule = $matricules[$i];
                        $importVehicle->vehicle_id = null;
                    }

                    $export->dossierVehicles()->save($importVehicle);
                    array_push($idVehicles,$importVehicle->id);
                }
            }
            DossierVehicles::whereNotIn('id',$idVehicles)->where('dossier_id',$export->id)->delete();
        }else{
            $export->dossierVehicles()->delete();
        }

        if($request->importItems){
            
            foreach (json_decode($request->importItems) as  $value) {
                
                if($value->id){
                    array_push($idImpItems,$value->id);
                    $importItem = DossierItem::find($value->id);
                    if(property_exists($value,'client_name')){
                        $importItem->client_id = $value->client;
                    }else{
                        if($request->client){
                            $importItem->client_id = $value->client->id;
                        }
                    }

                    $importItem->importateur = $value->importateur;
                    $importItem->exportateur = $value->exportateur;
                    
                    //&& $request->transitaire
                    //return "hi:".$request->transitaire;
                    //return json_decode($request->importItems);
                    //return $request->transitaire_id;
                    if(property_exists($value,'transitaire_name') && $request->transitaire_name != "Open this select menu"){
                        $importItem->transitaire_id = $value->transitaire;
                    }else if($request->transitaire_id != "Open this select menu"){
                        //return $request->transitaire_id;
                        $importItem->transitaire_id = $request->transitaire_id;
                    }
                    else{
                        if($request->transitaire){
                            $importItem->transitaire_id = $value->transitaire->id;
                        }else{
                            $importItem->transitaire_id = null;
                        }
                    }
                    

                    $importItem->marchandise = $value->marchandise;
                    $importItem->dum = $value->dum;
                    $importItem->numb_colis = $value->numb_colis;
                    $importItem->poid_brute = $value->poid_brute;
                    $importItem->observ = $value->observ;
                    $export->dossierItems()->save($importItem);
                    
                }else{
                    $importItem = new DossierItem();
                    $importItem->client_id = $value->client;
                    $importItem->importateur = $value->importateur;
                    $importItem->exportateur = $value->exportateur;
                    if($value->transitaire != 'Open this select menu'){
                        $importItem->transitaire_id = $value->transitaire;
                    }
                    $importItem->marchandise = $value->marchandise;
                    $importItem->dum = $value->dum;
                    $importItem->numb_colis = $value->numb_colis;
                    $importItem->poid_brute = $value->poid_brute;
                    $importItem->observ = $value->observ;
                    $export->dossierItems()->save($importItem);
                    array_push($idImpItems,$importItem->id);
                }
            }
            DossierItem::whereNotIn('id',$idImpItems)->where('dossier_id',$export->id)->delete();

        }

        if($request->type_frais && $request->montant && $request->devise){
            $idFrais = $request->IdFrais;
            $type_frais = $request->type_frais;
            $montant = $request->montant;
            $devise = $request->devise;
            for ($i=0; $i < count($type_frais) ; $i++) {
                if($idFrais[$i]){
                    array_push($idFraisPerso,$idFrais[$i]);
                    $personalExpense = PersonalExpense::find($idFrais[$i]);
                    $personalExpense->typeFrais_id = $type_frais[$i];
                    $personalExpense->montant = $montant[$i];
                    $personalExpense->devise = $devise[$i];
                    $export->personalExpenses()->save($personalExpense);
                }else{
                    $p = new PersonalExpense();
                    $p->typeFrais_id = $type_frais[$i];
                    $p->montant = $montant[$i];
                    $p->devise = $devise[$i];
                    $export->personalExpenses()->save($p);
                    array_push($idFraisPerso,$p->id);
                }

            }
             PersonalExpense::whereNotIn('id',$idFraisPerso)->where('dossier_id',$export->id)->delete();
        }else{
            $export->personalExpenses()->delete();
        }

        return redirect()->route('export.index')->with('message','Export est modifié avec succés');
    }



    public function documents($id)
    {
          $export=Dossier::findorFail($id);
          return view('exportss.document',compact('export'));
    }

    public function store_docs(Request $request)
    {
         $id =$request->input('dossier_id');
         $import=Dossier::findorFail($id);

        foreach ($request->input('file', []) as $file) {
            $import->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('export_file');
        }
        return back()->with('message','Fichiers sont ajoutés avec succés');
    }

    public function destroy($export){
        $this->authorize('delete',Dossier::class);
        $v = Dossier::findOrFail($export)->delete();
        if($v){
            return response()->json([
                'message' => 'Dossier Export est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs s'est passé",
                'success' => false
            ]);
        }
    }
}
