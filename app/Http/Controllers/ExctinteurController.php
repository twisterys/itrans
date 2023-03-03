<?php

namespace App\Http\Controllers;

use App\Exctinteur;
use App\Http\Requests\ExctinteurStoreRequest;
use App\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExctinteurController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Vehicle $vehicle)
    {

        if ($request->ajax()) {
        $data = Exctinteur::with('vehicle')->where('vehicle_id',$vehicle->id)->get();
        
            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $editLink = route('vehicle.exctinteur.edit',[$row->vehicle->id,$row->id]);
                $donwload = route('vehicle.exctinteur.download',$row->id);

                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteExtincteur('.$row->vehicle->id.','.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                $btn .= '<a href="'.$donwload.'" class="btn btn-secondary btn-sm mr-1">Télécharger</a>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('client', function ($row) {
                return $row->client ? $row->client : '';
            });
            $table->editColumn('mat_vehicle', function ($row) {
                return $row->vehicle->N_immatriculation ? $row->vehicle->N_immatriculation : '';
            });
            $table->editColumn('date_last_control', function ($row) {
                return $row->date_last_control ? $row->date_last_control : '';
            });
            $table->editColumn('date_next_control', function ($row) {
                return $row->date_next_control ? $row->date_next_control : '';
            });
            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('exctinteur.index',compact('vehicle'));

    }


    public  function create(Vehicle $vehicle){
        return view('exctinteur.create',compact('vehicle'));
    }

    public function show(Vehicle $vehicle,Exctinteur $exctinteur){
        

    }

    /**
     * @param \App\Http\Requests\ExctinteurStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExctinteurStoreRequest $request)
    {
        $ex = Exctinteur::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $ex->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('exctinteur_file');
        }


        return back()->with('message','Exctinteur est crée avec succés');  
    }

    public function edit(Vehicle $vehicle,Exctinteur $exctinteur){
        return view('exctinteur.edit',compact('vehicle','exctinteur'));
    }

    public function update(ExctinteurStoreRequest $request,Vehicle $vehicle,Exctinteur $exctinteur){
        $exctinteur->update($request->all());

        if (count($exctinteur->exctinteur_file) > 0) {
            foreach ($exctinteur->exctinteur_file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $exctinteur->exctinteur_file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $exctinteur->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('exctinteur_file');
            }
        }

        return back()->with('message','Exctincteur est modifié avec succés');
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

    public function dowload($id){
        $ext = Exctinteur::with('media')->whereId($id)->first();
        if($ext->exctinteur_file == '[]'){
            return back()->with('warning',"Vous n'avez pas encore ajouté des fichiers");
        }else{
            foreach ($ext->exctinteur_file as $value) {
                return $value;
            }
        }
    }

    public function destroy($vehicle,$extincteur){
        $v = Exctinteur::findOrFail($extincteur)->delete();
        if($v){
            return response()->json([
                'message' => 'Extincteur est supprimé avec succées',
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
