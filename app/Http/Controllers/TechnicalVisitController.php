<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnicalVisitStoreRequest;
use App\TechnicalVisit;
use App\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TechnicalVisitController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,Vehicle $vehicle)
    {
        $technicalvisits = TechnicalVisit::all();

        if ($request->ajax()) {
            $data = TechnicalVisit::with('vehicle')->where('vehicle_id',$vehicle->id)->get();
        
            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $editLink = route('vehicle.technicalVisit.edit',[$row->vehicle->id,$row->id]);
                $donwload = route('vehicle.technicalVisit.download',$row->id);
                $btn = '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                $btn .= '<button onclick="deleteTechnicalVisit('.$row->vehicle->id.','.$row->id.')" class="btn btn-danger btn-sm mr-1">Supprimer</button>';
                $btn .= '<a href="'.$donwload.'" class="btn btn-secondary btn-sm mr-1">Télécharger</a>';

                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('ref', function ($row) {
                return $row->ref ? $row->ref : '';
            });
            $table->editColumn('date_next_visit', function ($row) {
                return $row->date_next_visit ? $row->date_next_visit : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }


        return view('technical_visit.index',compact('vehicle'));
    }

    public function create(Vehicle $vehicle){
        return view('technical_visit.create',compact('vehicle'));
    }

    /**
     * @param \App\Http\Requests\TechnicalVisitStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechnicalVisitStoreRequest $request)
    {
        $TV = TechnicalVisit::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $TV->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('TechnicalVisit_file');
        }

        return redirect()->route('vehicle.technicalVisit.index',$request->vehicle_id)->with('message','Visite Technique est crée avec succés');
    }

    public function edit(Vehicle $vehicle,TechnicalVisit $technicalVisit){
        return view('technical_visit.edit',compact('vehicle','technicalVisit'));
    }

    public function update(Request $request,Vehicle $vehicle,TechnicalVisit $technicalVisit){
        $technicalVisit->update($request->all());

        if (count($technicalVisit->TechnicalVisit_file) > 0) {
            foreach ($technicalVisit->TechnicalVisit_file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        
        $media = $technicalVisit->TechnicalVisit_file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $technicalVisit->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('TechnicalVisit_file');
            }
        }
        
        return back()->with('message','Visite Technique est modifié');
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
        $techVisit = TechnicalVisit::with('media')->whereId($id)->first();
        if($techVisit->TechnicalVisit_file == '[]'){
            return back()->with('warning',"Vous n'avez pas encore ajouté des fichiers");
        }else{
            foreach ($techVisit->TechnicalVisit_file as $value) {
                return $value;
            }
        }
    }

    public function destroy($vehicle,$technicalVisit){
        $v = TechnicalVisit::findOrFail($technicalVisit)->delete();
        if($v){
            return response()->json([
                'message' => 'Technique visite est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs s'est, passé refaire cette action aprés",
                'success' => false
            ]);
        }
    }
}
