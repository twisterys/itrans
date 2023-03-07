<?php

namespace App\Http\Controllers;

use App\Client;
use App\Depot;
use App\DossierPlomos;
use App\Http\Requests\StoreMagasinageRequest;
use App\Magasinage;
use App\MagasinagePlomos;
use App\MagasinageServices;
use App\Plomo;
use App\Service;
use App\TypePackaging;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;


class MagasinageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        ;
        $this->authorize('viewAny',Magasinage::class);
        $data = null;

        if(auth()->user()->is_admin){
            $data = Magasinage::with(['client','depot:id,nom,ville'])->get();
        }else{
            $user = auth()->user();
            $data = $user->magasinages()->get();
        }

        if ($request->ajax()) {


        $table = Datatables::of($data);

        $table->addColumn('placeholder', '&nbsp;');
        $table->addColumn('actions', '&nbsp;');

        $table->editColumn('actions', function ($row) {
            $showLink = route('magasinage.show',$row->id);
            $editLink = route('magasinage.edit',$row->id);
            $deleteLink = 'deleteMagasinage('.$row->id.')';
            $downloadLink = route('magasinage.download',$row->id);
            return view('partials.magasinageActions',compact('editLink','deleteLink','showLink','downloadLink'));

            //$btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
            //$btn .= '<button onclick="deleteMagasinage('.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
            //$btn .= '<a href="'.$donwload.'" class="btn btn-secondary btn-sm mr-1">Télécharger</a>';
            //return $btn;
        });

        $table->editColumn('id', function ($row) {
            return $row->id ? $row->id : '';
        });
        $table->editColumn('client', function ($row) {
            return $row->client? $row->client->nom : '';
        });
        $table->editColumn('date_entree', function ($row) {
            return $row->date_entree ? $row->date_entree : '';
        });
        $table->editColumn('date_sortie', function ($row) {
            return $row->date_sortie ? $row->date_sortie : '';
        });
        $table->editColumn('mat_entree', function ($row) {
            return $row->mat_entree ? $row->mat_entree : '';
        });
        $table->editColumn('mat_sortie', function ($row) {
            return $row->mat_sortie ? $row->mat_sortie : '';
        });
        $table->editColumn('depot', function ($row) {
            return $row->depot ? $row->depot->nom.'('.$row->depot->ville.')' : '';
        });
        $table->editColumn('prix', function ($row) {
            return $row->prix ? $row->prix : '';
        });


        $table->rawColumns(['actions', 'placeholder']);

        return $table->make(true);
    }

        return view('magasinage.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Magasinage::class);

        $clients = Client::all();

        $plomos = Plomo::where('used_at',null)->where('defaillante',0)->where('traiter_a',NULL)->get();
        $depots = Depot::all();
        $packages = TypePackaging::all();
        $services = Service::all();
        return view('magasinage.create',compact('depots','plomos','clients','services','packages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMagasinageRequest $request)
    {
        $this->authorize('create',Magasinage::class);


        $total_price = 0;
        if($request->price && $request->service_id ) {
            $service_id = $request->service_id;
            $price = $request->price;
            for ($i = 0; $i < count($service_id); $i++) {
                if (Service::where('id', $service_id[$i])->exists() && $price[$i] != null) {
                    $total_price += $price[$i];
                }
            }
        }

        $request->merge(['prix' => $total_price]);
        $magasinage = Magasinage::create($request->all());

        /* if($request->plomos){
            foreach ($request->plomos as $plomo) {
                $plomos = Plomo::findOrFail($plomo);
                $plomos->update([
                     'used_at' => Carbon::now(),
                     'havePlomos_type' => 'App\Magasinage',
                     'havePlomos_id' => $magasinage->id
                ]);
            }
        } */

        if($request->price && $request->service_id){

            $price = $request->price;
            $comment = $request->comment;
            $service_id = $request->service_id;


            for ($i=0; $i <count($service_id) ; $i++) {
                if(Service::where('id',$service_id[$i])->exists() && $price[$i]!=null ){
                    MagasinageServices::create([
                        'magasinage_id' => $magasinage->id,
                        'service_id' => $service_id[$i],
                        'price'=> $price[$i],
                        'comment'=> $comment[$i]??null,
                    ]);
                }
            }
        }

        foreach ($request->input('file', []) as $file) {
            $magasinage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('magasinage_file');
        }
        return redirect()->route('magasinage.index')->with('message','Magasinage est crée avec succées');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Magasinage  $magasinage
     * @return \Illuminate\Http\Response
     */
    public function show(Magasinage $magasinage)
    {
        //$this->authorize('show',Magasinage::class);
        $magasinage->load('depot');
        $magasinageServices = MagasinageServices::with('service')->where('magasinage_id',$magasinage->id)->get();
        return view('magasinage.show',compact('magasinage','magasinageServices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Magasinage  $magasinage
     * @return \Illuminate\Http\Response
     */
    public function edit(Magasinage $magasinage)
    {
        $this->authorize('update',Magasinage::class);

        $clients = Client::all();
        $plomosNotUsed = Plomo::where('used_at',null)->where('defaillante',0)->where('traiter_a',NULL)->get();
        $magasinagePlomos = $magasinage->plomos()->get();
        $plomos = $magasinagePlomos->merge($plomosNotUsed);
        $magasinage->load('client');
        $magasinageServices = MagasinageServices::with('service')->where('magasinage_id',$magasinage->id)->get();
        $packages = TypePackaging::all();
        $services = Service::all();
        $magasinageService = MagasinageServices::all();
        //return $plomos;
        $depots = Depot::all();
        return view('magasinage.edit',compact('magasinage','depots','plomos','clients','services','packages','magasinageServices','magasinageService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Magasinage  $magasinage
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMagasinageRequest $request, Magasinage $magasinage)
    {

        //return $request->num_bon;
        $this->authorize('update',Magasinage::class);

        $total_price = 0;
        if($request->price && $request->services ) {
            $service_id = $request->services;
            $price = $request->price;
            for ($i = 0; $i < count($service_id); $i++) {
                if (Service::where('id', $service_id[$i])->exists() && $price[$i] != null) {
                    $total_price += $price[$i];
                }
            }
        }

        $request->merge(['prix' => $total_price]);

        $magasinage->update($request->all());


        if($request->price && $request->services){


            $price = $request->price;
            $comment = $request->comment;
            $service_id = $request->services;

            for ($i = 0; $i < count($service_id); $i++) {
                if (Service::where('id', $service_id[$i])->exists() && $price[$i] != null) {
                    $magasinageServices = MagasinageServices::where('magasinage_id', $magasinage->id)->get();


                    if ($magasinageServices->isEmpty()) {
                        MagasinageServices::create([
                            'magasinage_id' => $magasinage->id,
                            'service_id' => $service_id[$i],
                            'price' => $price[$i],
                            'comment' => $comment[$i] ?? null,
                        ]);
                    } else {
                        $magasinageService = $magasinageServices[$i] ?? null;
                        if ($magasinageService) {
                            $magasinageService->update([
                                'service_id' => $service_id[$i],
                                'price' => $price[$i],
                                'comment' => $comment[$i] ?? null,
                            ]);
                        } else {
                            MagasinageServices::create([
                                'magasinage_id' => $magasinage->id,
                                'service_id' => $service_id[$i],
                                'price' => $price[$i],
                                'comment' => $comment[$i] ?? null,
                            ]);
                        }
                }}
            }

        }

        if($request->plomos){

            foreach ($request->plomos as $plomo) {
                if(!$magasinage->plomos->contains($plomo)){
                    $plomos = Plomo::findOrFail($plomo);
                    $plomos->update([
                        'used_at' => Carbon::now(),
                        'havePlomos_type' => 'App\Magasinage',
                        'havePlomos_id' => $magasinage->id
                   ]);

                }
            }
            $magasinage->plomos()->whereNotIn('id',$request->plomos)->update([
                'used_at' => null,
                'havePlomos_type' => null,
                'havePlomos_id' => null
            ]);
        }else{
            $magasinage->plomos()->update([
                'used_at' => null,
                'havePlomos_type' => null,
                'havePlomos_id' => null
            ]);
        }
        if (count($magasinage->magasinage_file) > 0) {
            foreach ($magasinage->magasinage_file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $magasinage->magasinage_file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $magasinage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('magasinage_file');
            }
        }

        return back()->with('message','Magasinage est modifié avec succées');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Magasinage  $magasinage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magasinage $magasinage)
    {
        $v =  $magasinage->delete();
        if($v){
            return response()->json([
                'message' => 'Magasinage est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs, refaire cette action aprés",
                'success' => false
            ]);
        }
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

    public function download(Magasinage $magasinage){

        $pdf = FacadePdf::loadView('magasinage.download', ['magasinage' => $magasinage]);
        return $pdf->download('dossier_'.$magasinage->id.'.pdf');


    }


    public function showPublic($id){

        $magasinage=Magasinage::find($id);
        $magasinageServices = MagasinageServices::with('service')->where('magasinage_id',$magasinage->id)->get();
        return view('magasinage.showPublic',compact('magasinage','magasinageServices'));
    }
}
