<?php

namespace App\Http\Controllers;

use App\Assurance;
use App\Http\Requests\AssuranceStoreRequest;
use App\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AssuranceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Vehicle $vehicle)
    {
        if ($request->ajax()) {
            $data = Assurance::with('vehicle')->where('vehicle_id',$vehicle->id)->get();
        
            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $editLink = route('vehicle.assurance.edit',[$row->vehicle->id,$row->id]);
                $deleteLink = route('vehicle.assurance.destroy',[$row->vehicle->id,$row->id]);
                $donwload = route('vehicle.assurance.download',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteAssurance('.$row->vehicle->id.','.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                $btn .= '<a href="'.$donwload.'" class="btn btn-secondary btn-sm mr-1">Télécharger</a>';
                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->date : '';
            });
            $table->editColumn('expiration', function ($row) {
                return $row->expiration ? $row->expiration : '';
            });
            $table->addColumn('asseureur', function ($row) {
                return $row->asseureur ? $row->asseureur : '';
            });
            $table->addColumn('police', function ($row) {
                return $row->police ? $row->police : '';
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }


        return view('assurance.index',compact('vehicle'));
    }

    public function create(Vehicle $vehicle){
        return view('assurance.create',compact('vehicle'));
    }

    /**
     * @param \App\Http\Requests\AssuranceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssuranceStoreRequest $request)
    {
        $ass = Assurance::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $ass->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('assurance_file');
        }

        return redirect()->route('vehicle.assurance.index',$request->vehicle_id)->with('message','Assurance ajouté avec succées');
    }

    public function edit(Vehicle $vehicle,Assurance $assurance){
        
        return view('assurance.edit',compact('vehicle','assurance'));
    }

    public function update(AssuranceStoreRequest $request,Vehicle $vehicle,Assurance $assurance){
        $assurance->update($request->all());

        if (count($assurance->assurance_file) > 0) {
            foreach ($assurance->assurance_file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $assurance->assurance_file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $assurance->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('assurance_file');
            }
        }

        return back()->with('message','Assurance est modifié avec succés');
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
        $assurance = Assurance::with('media')->whereId($id)->first();
        if($assurance->assurance_file == '[]'){
            return back()->with('warning',"Vous n'avez pas encore ajouté des fichiers");
        }else{
            foreach ($assurance->assurance_file as $value) {
                return $value;
            }
        }
    }

    public function destroy($vehicle,$assurance){
        $v = Assurance::findOrFail($assurance)->delete();
        if($v){
            return response()->json([
                'message' => 'Assurance est supprimé avec succées',
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
