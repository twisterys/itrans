<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ImportStoreRequest;
use App\Import;
use App\ImportItem;
use App\PersonalExpense;
use App\Vehicle;
use App\Dossier;
use App\DossierItem;
use App\DossierPlomos;
use App\DossierVehicles;
use App\MagasinagePlomos;
use App\Person;
use App\Plomo;
use App\Transitaire;
use App\TypeFrais;
use App\TypeVehicle;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToArray;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\DataTables;
use PDF;


class ImportController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Dossier::class);
        if ($request->ajax()) {
            $data = Dossier::where('type','import')->with(['media','dossierItems' => function($q){
                $q->with('client');
            },'dossierVehicles' => function($q){
                $q->with('vehicles');
            }])->get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $showLink = route('import.show',$row->id);
                $editLink = route('import.edit',$row->id);
                $deleteLink = 'deleteImport('.$row->id.')';
                $docsLink = route('import.documents',$row->id);
                $downloadLink = route('import.download',$row->id);

                return view('partials.importActions',compact('showLink','editLink','deleteLink','docsLink','downloadLink'));

                //$btn = '<a href="'.$showLink.'" class="btn btn-info btn-sm mr-1">Afficher</a>';
                //$btn .= '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                //$btn .= '<button type="button" class="btn btn-danger btn-sm mr-1" onclick="deleteImport('.$row->id.')">Supprimer</button>';
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

            $table->addColumn('num_connaissement', function ($row) {
                return $row->num_connaissement ? $row->num_connaissement : '';
            });
            $table->addColumn('vehicule', function ($row) {
                $html='';
                foreach($row->dossierVehicles as $vehicule)
                {
                    $html.= '<span class="badge bg-info text-white mr-1">'.($vehicule->vehicle_id ? $vehicule->vehicles->N_immatriculation : $vehicule->matricule).'</span>';

                }
                return $html;

            });


            $table->rawColumns(['driver','vehicule','actions', 'placeholder','vehicule']);

            return $table->make(true);
        }


        return view('importss.index');
    }

    public function show(Dossier $import)
    {
        $this->authorize('view',Dossier::class);
        $import->load(['personalExpenses','dossierItems','dossierVehicles','plomos','chauffeur']);
        $import->dossierVehicles->load(['vehicles','TypeVehicle']);
        $import->personalExpenses->load('TypeFrais');
        $import->dossierItems->load('client');

        //return $import;
        return view('importss.show',compact('import'));
    }

    public function show_(Request $request,Dossier $import){
        if ($request->ajax()) {
            $data = DossierItem::where('dossier_id',$import->id)->latest()->get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $btn = '';
                return $btn;
            });

            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('client', function ($row) {
                return $row->client ? $row->client : '';
            });
            $table->editColumn('importateur', function ($row) {
                return $row->importateur ? $row->importateur : '';
            });
            $table->editColumn('exportateur', function ($row) {
                return $row->exportateur ? $row->exportateur : '';
            });
            $table->editColumn('transitaire', function ($row) {
                return $row->transitaire ? $row->transitaire : '';
            });
            $table->editColumn('marchandise', function ($row) {
                return $row->marchandise ? $row->marchandise : '';
            });
            $table->editColumn('dum', function ($row) {
                return $row->dum ? $row->dum : '';
            });
            $table->editColumn('numb_colis', function ($row) {
                return $row->numb_colis ? $row->numb_colis : '';
            });
            $table->editColumn('poid_brute', function ($row) {
                return $row->poid_brute ? $row->poid_brute : '';
            });
            $table->editColumn('observ', function ($row) {
                return $row->observ ? $row->observ : '';
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $import->load(['personalExpenses','dossierItems']);
        return view('importss.show',compact('import'));
    }

    public function create(Request $request){
        $this->authorize('create',Dossier::class);
        //$AllDossierPlomos = DossierPlomos::pluck('num_serie');
        //$plomoMagasinage = MagasinagePlomos::pluck('num_serie');
        $plomos = Plomo::where('used_at',null)->where('defaillante',0)->where('traiter_a',NULL)->get();

        $clients = Client::all();
        $transitaires = Transitaire::all();

        $chauffeurs = Person::where('fonction','chauffeur')->get();


        $typeVehicle = TypeVehicle::where('active',1)->get();
        $typeFrais = TypeFrais::where('active',1)->get();
        $vehicles = Vehicle::pluck('N_immatriculation');
        $drivers = Person::where('fonction','chauffeur')->get(['nom','prenom','cin']);

        return view('importss.create',compact('vehicles','typeVehicle','typeFrais','drivers','plomos','clients','transitaires','chauffeurs'));
        // return view('importss.file');
    }

    /**
     * @param \App\Http\Requests\ImportStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImportStoreRequest $request)
    {
        $this->authorize('create',Dossier::class);

        $import = Dossier::create($request->all());
        $import->type='import';
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
                $importVehicle->typeVehicle_id = $typeVehicles[$i];//change

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

        return redirect()->route('import.index')->with('message','Import est crée avec succés');

    }


    public function edit(Dossier $import){
        $this->authorize('update',Dossier::class);

        $plomosNotUsed = Plomo::where('used_at',null)->where('defaillante',0)->where('traiter_a',NULL)->get();


        $import->load(['dossierVehicles','dossierItems','personalExpenses','plomos'])->where('type','import');
        $import->dossierVehicles->load('vehicles');
        $import->personalExpenses->load('TypeFrais');
        $import->dossierItems->load(['client','transitaire']);


        $dossierPlomos = $import->plomos()->get();
        $plomos = $dossierPlomos->merge($plomosNotUsed);


        $clients = Client::all();
        $transitaires = Transitaire::all();
        $chauffeurs = Person::where('fonction','chauffeur')->get();

        $typeVehicle = TypeVehicle::where('active',1)->get();
        $typeFrais = TypeFrais::where('active',1)->get();
        $vehicles = Vehicle::pluck('N_immatriculation');
        $drivers = Person::where('fonction','chauffeur')->get(['nom','prenom','cin']);
        return view('importss.edit',compact('import','vehicles','typeVehicle','typeFrais','drivers','plomos','clients','transitaires','chauffeurs'));
    }

    public function update(ImportStoreRequest $request,Dossier $import){


        $idImpItems = array();
        $idVehicles = array();
        $idFraisPerso = array();


        $import->update($request->all());

        if($request->chauffeurs){
            $import->chauffeur()->sync($request->chauffeurs);
        }else{
            $import->chauffeur()->sync(null);
        }

        if($request->plomos){

            foreach ($request->plomos as $plomo) {

                if(!$import->plomos->contains($plomo)){
                    $plomos = Plomo::findOrFail($plomo);
                    $plomos->update([
                        'used_at' => Carbon::now(),
                        'havePlomos_type' => 'App\Dossier',
                        'havePlomos_id' => $import->id
                   ]);

                }
            }

            $import->plomos()->whereNotIn('id',$request->plomos)->update([
                'used_at' => null,
                'havePlomos_type' => null,
                'havePlomos_id' => null
            ]);

        }else{
            $import->plomos()->update([
                'used_at' => null,
                'havePlomos_type' => null,
                'havePlomos_id' => null
            ]);
        }



        if($request->type_vehicle && $request->matriculeVehicle){
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

                    $import->dossierVehicles()->save($importVehicle);
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

                    $import->dossierVehicles()->save($importVehicle);
                    array_push($idVehicles,$importVehicle->id);
                }
            }
            DossierVehicles::whereNotIn('id',$idVehicles)->where('dossier_id',$import->id)->delete();
        }else{
            $import->dossierVehicles()->delete();
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
                    $import->dossierItems()->save($importItem);

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
                    $import->dossierItems()->save($importItem);
                    array_push($idImpItems,$importItem->id);
                }
            }
            DossierItem::whereNotIn('id',$idImpItems)->where('dossier_id',$import->id)->delete();

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
                    $import->personalExpenses()->save($personalExpense);
                }else{
                    $p = new PersonalExpense();
                    $p->typeFrais_id = $type_frais[$i];
                    $p->montant = $montant[$i];
                    $p->devise = $devise[$i];
                    $import->personalExpenses()->save($p);
                    array_push($idFraisPerso,$p->id);
                }

            }
             PersonalExpense::whereNotIn('id',$idFraisPerso)->where('dossier_id',$import->id)->delete();
        }else{
            $import->personalExpenses()->delete();
        }

        return redirect()->route('import.index')->with('message','Import est modifié avec succés');
    }

    public function documents($id)
    {
          $import=Dossier::findorFail($id);

        //   dd($import);
          return view('importss.document',compact('import'));
    }

    public function store_docs(Request $request)
    {
         $id =$request->input('import_id');
         $import=Dossier::findorFail($id);

        foreach ($request->input('file', []) as $file) {
            $import->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('import_file');
        }
        return back()->with('message','Fichiers sont ajoutés avec succés');
    }

    public function storeMedia(Request $request)
    {

// Validates file size
        if (request()->has('size')) {
            $this->validate(request(), [
                'file' => 'max:' . request()->input('size') * 1024,
            ]);
        }

// If width or height is preset - we are validating it as an image
        if (request()->has('width') || request()->has('height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('width', 100000),
                    request()->input('height', 100000)
                ),
            ]);
        }

        $path = storage_path('tmp'.DIRECTORY_SEPARATOR.'uploads');

        try {
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
        } catch (\Exception $e) {
        }

        $file = $request->file('file');

        $name = $file->getClientOriginalName();
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function destroy($import){
        $this->authorize('delete',Dossier::class);
        $v = Dossier::findOrFail($import)->delete();
        if($v){
            return response()->json([
                'message' => 'Dossier Import est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs s'est passé",
                'success' => false
            ]);
        }
    }

    public function download(Dossier $import){

        $import->load(['dossierItems','dossierVehicles','chauffeur']);
        $import->dossierVehicles->load('vehicles');
        $import->dossierVehicles->load('TypeVehicle');
        $import->personalExpenses->load('TypeFrais');
        $import->dossierItems->load('client');

        $pdf = FacadePdf::loadView('importss.download', ['import' => $import]);
//               $pdf->setOptions(['defaultFont' => 'sans-serif','isRemoteEnabled' => true]);

        return $pdf->download('dossier_'.$import->id.'.pdf');


    }

    public function deleteDoc(Media $media){
        $m = $media->delete();

        if($m){
            return response()->json([
                'message' => 'Document est supprimé avec succées',
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
