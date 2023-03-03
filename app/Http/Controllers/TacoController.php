<?php

namespace App\Http\Controllers;

use App\Http\Requests\TacoStoreRequest;
use App\Taco;
use App\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TacoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Vehicle $vehicle)
    {
        if ($request->ajax()) {
            $data = Taco::with('vehicle:id')->where('vehicle_id',$vehicle->id)->get();
        
            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                //$showLink = route('vehicle.taco.show',[$row->vehicle->id,$row->id]);
                $editLink = route('vehicle.taco.edit',[$row->vehicle->id,$row->id]);
                $visiteTechnique = route('taco.visiteTechnique.index',$row->id);
                $donwload = route('vehicle.taco.download',$row->id);

                //$btn = '<a href="'.$showLink.'" class="btn btn-info btn-sm mr-1">Afficher</a>';
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteTaco('.$row->vehicle->id.','.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                $btn .= '<a href="'.$donwload.'" class="btn btn-secondary btn-sm mr-1">Télécharger</a>';
                $btn .= '<a href="'.$visiteTechnique.'" target="_Blank" class="btn btn-primary btn-sm mr-1">Visite Technique</a>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('num_homologation', function ($row) {
                return $row->num_homologation ? $row->num_homologation : '';
            });
            $table->editColumn('marque', function ($row) {
                return $row->marque ? $row->marque : '';
            });
            $table->editColumn('num_serie', function ($row) {
                return $row->num_serie ? $row->num_serie : '';
            });
            $table->addColumn('date_validation', function ($row) {
                return $row->date_validation ? $row->date_validation : '';
            });
            $table->addColumn('date_expiration', function ($row) {
                return $row->date_expiration ? $row->date_expiration : '';
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }
        return view('taco.index',compact('vehicle'));
    }

    public function create(Vehicle $vehicle){
        return view('taco.create',compact('vehicle'));
    }

    /**
     * @param \App\Http\Requests\TacoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TacoStoreRequest $request)
    {
        $taco = Taco::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $taco->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('taco_file');
        }

        return redirect()->route('vehicle.taco.index',$request->vehicle_id)->with('message','Chnronotachygraphe ajouté avec succés');
    }

    public function edit(Vehicle $vehicle,Taco $taco){
        return view('taco.edit',compact('vehicle','taco'));
    }

    public function update(TacoStoreRequest $request,Vehicle $vehicle,Taco $taco){
        $taco->update($request->all());

        if (count($taco->taco_file) > 0) {
            foreach ($taco->taco_file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $taco->taco_file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $taco->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('taco_file');
            }
        }

        return back()->with('message','Chnronotachygraphe modifié avec succés');
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
        $taco = Taco::with('media')->whereId($id)->first();
        if($taco->taco_file == '[]'){
            return back()->with('warning',"Vous n'avez pas encore ajouté des fichiers");
        }else{
            foreach ($taco->taco_file as $value) {
                return $value;
            }
        }
    }

    public function destroy($vehicle,$taco){
        $v = Taco::findOrFail($taco)->delete();
        if($v){
            return response()->json([
                'message' => 'Disque est supprimé avec succées',
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
