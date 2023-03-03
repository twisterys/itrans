<?php

namespace App\Http\Controllers;

use App\Assurance;
use App\Events\NewVehicle;
use App\Http\Requests\VehicleStoreRequest;
use App\Mail\ReviewVehicle;
use App\TechnicalVisit;
use App\TypeVehicle;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class VehicleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',Vehicle::class);
        if ($request->ajax()) {
            $data = Vehicle::latest()->get();
        
            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                
                $showLink = route('vehicle.show',$row->id);
                $editLink = route('vehicle.edit',$row->id);
                $deleteLink = 'deleteVehicle('.$row->id.')';
                return view('partials.vehicleActions',compact('showLink','editLink','row','deleteLink'));
                
                //$btn = '<a href="'.$showLink.'" class="btn btn-info btn-sm mr-1">Afficher</a>';
                //$btn .= '<a href="'.$editLink.'" class="btn btn-warning btn-sm mr-1">Modifier</a>';
                //$btn .= '<button type="button" class="btn btn-danger btn-sm mr-1 delete-form" onclick="deleteVehicle('.$row->id.')">Supprimer</button>';
                
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('N_immatriculation', function ($row) {
                return $row->N_immatriculation ? $row->N_immatriculation : '';
            });
            $table->editColumn('marque', function ($row) {
                return $row->marque ? $row->marque : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? $row->type : '';
            });
            $table->addColumn('genre', function ($row) {
                return $row->genre ? $row->genre : '';
            });
            $table->addColumn('proprietaire', function ($row) {
                return $row->proprietaire ? $row->proprietaire : '';
            });


            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }


        return view('vehicle.index');
    }

    public function show(Vehicle $vehicle){
        $this->authorize('view',Vehicle::class);
        $vehicle->load([
        'assurances' => function($q){
            $q->orderBy('expiration', 'desc')->first();
        },
        'technicalVisits' => function($q){
            $q->orderBy('date_next_visit', 'desc')->first();
        },
        'tacos' => function($q){
            $q->orderBy('date_expiration','desc')->first();
            $q->with(['visitTechnique' => function($q2){
                $q2->orderBy('date_next_visit', 'desc')->first();
            }]);
        },
        'extinteurs' => function($q){
            $q->orderBy('date_next_control','desc')->first();
        }]);
        //return $vehicle->tacos;
        return view('vehicle.show',compact('vehicle'));
    }

    public function create(){
        $this->authorize('create',Vehicle::class);
        $typeVehicle = TypeVehicle::where('active',1)->get(['id','name']);
        return view('vehicle.create',compact('typeVehicle'));
    }

    /**
     * @param \App\Http\Requests\VehicleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleStoreRequest $request)
    { 
        $this->authorize('create',Vehicle::class);
        $vehicle = Vehicle::create($request->all());

        foreach ($request->input('file', []) as $file) {
            $vehicle->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('vehicle_file');
        }

        return redirect()->route('vehicle.index')->with('message','Vehicule est ajouté avec succes');
    }

    public function edit(Vehicle $vehicle){
        $this->authorize('update',Vehicle::class);
        $typeVehicle = TypeVehicle::where('active',1)->get(['id','name']);
        return view('vehicle.edit',compact('vehicle','typeVehicle'));
    }

    public function update(VehicleStoreRequest $request,Vehicle $vehicle){
        $this->authorize('update',Vehicle::class);

        $vehicle->update($request->all());

        if (count($vehicle->vehicle_file) > 0) {
            foreach ($vehicle->vehicle_file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $vehicle->vehicle_file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $vehicle->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('vehicle_file');
            }
        }
        
        return back()->with('message','Vehicule est modifié avec succes');;
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

    public function destroy($vehicle){
        $this->authorize('delete',Vehicle::class);
        $v = Vehicle::findOrFail($vehicle)->delete();
        if($v){
            return response()->json([
                'message' => 'Vehicule est supprimé avec succées',
                'success' => true
            ]);
        }else{
            return response()->json([
                'message' => "Un erreurs s'est passé refaire cette action aprés",
                'success' => false
            ]);
        }
    }
}
