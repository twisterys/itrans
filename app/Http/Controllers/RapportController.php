<?php

namespace App\Http\Controllers;

use App\Dossier;
use App\DossierVehicles;
use App\Jobs\kilometrageChauffeurProcesus;
use App\Jobs\KilometrageVehicleProcessus;
use App\Jobs\PlomosProcessus;
use App\Magasinage;
use App\PersonalExpense;
use App\Plomo;
use App\Rapport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\Support\MediaStream;
use Yajra\DataTables\DataTables;

class RapportController extends Controller
{

    public function index(Request $request){

        //return Rapport::all();
        if ($request->ajax()) {
            $data = Rapport::get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $download = route('rapport.download',$row->id);
                $btn = '<a href="'.$download.'" class="btn btn-warning btn-sm mr-1">Télécharger</a>';

                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Rapport::TYPE_RAPPORT[$row->type] : '';
            });
            $table->editColumn('premiere_date', function ($row) {
                return $row->premiere_date ? $row->premiere_date : '';
            });
            $table->editColumn('deuxieme_date', function ($row) {
                return $row->deuxieme_date ? $row->deuxieme_date : '';
            });
            $table->editColumn('date_creation', function ($row) {
                return $row->date_creation ? $row->date_creation : '';
            });
            $table->editColumn('status', function ($row) {

                if($row->status == 'complet'){
                    return '<span class="badge bg-success text-white">'.Rapport::STATUS[$row->status].'</span>';
                }else{
                    return '<span class="badge bg- text-white">'.Rapport::STATUS[$row->status].'</span>';
                }

            });



            $table->rawColumns(['status','actions', 'placeholder']);

            return $table->make(true);
        }
        return view('rapport.index');

    }


    public function kilometrage(){
        if(auth()->user()->is_admin || auth()->user()->hasPermissionTo('view_rapport')){
            $rapports = null;
            $first_date = null;
            $second_date = null;
            $type_rapport = null;
            return view('rapport.calculKilometrage',compact('rapports','first_date','second_date','type_rapport'));
        }else{
            abort(403);
        }
    }

    public function calculKilometrage(Request $request){
        if(auth()->user()->is_admin || auth()->user()->hasPermissionTo('view_rapport')){

            $request->validate([
                'type_rapport' => 'required',
                'first_date' => 'required',
                'second_date' => 'required',
            ]);


            $first_date = $request->first_date;
            $second_date = $request->second_date;
            $user_id = auth()->user()->id;

        $rapports = Dossier::join('dossier_vehicle','dossier_vehicle.dossier_id','=','dossiers.id')
        ->join('vehicles','vehicles.id','=','dossier_vehicle.vehicle_id')
        ->join('type_vehicles','type_vehicles.id','=','dossier_vehicle.typeVehicle_id')
        ->whereBetween('date',[$first_date,$second_date])
        ->select(['vehicles.N_immatriculation','type_vehicles.name','dossiers.type'])
        ->selectRaw('sum(kilometrage) as sum_kilometrage')
        ->selectRaw('sum(nb_jour_etranger) as nbJour_etranger')
        ->selectRaw('sum(nb_jour_maroc) as nbJour_maroc')
        ->selectRaw('count(*) as sum_dossier')
        ->groupBy(['vehicles.N_immatriculation','type_vehicles.name','dossiers.type'])
        ->get();





            if($request->type_rapport == 'plomos'){
                PlomosProcessus::dispatch($first_date,$second_date,$user_id);
            }else if($request->type_rapport == 'kilometrage_vehicle'){
                KilometrageVehicleProcessus::dispatch($first_date,$second_date,$user_id);
            }else{
                kilometrageChauffeurProcesus::dispatch($first_date,$second_date,$user_id);
            }

            return redirect()->route('rapport.index')->with('message','Rapport est crée avec succées');

        return view('rapport.calculKilometrage',compact('rapports','first_date','second_date'));

        }else{
            abort(403);
        }


    }

    public function typeRapport(Request $request,$id){

        if ($request->ajax()) {
            $data = Rapport::where('type',$id)->get();

            $table = Datatables::of($data);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {

                $download = route('rapport.download',$row->id);
                $btn = '<a href="'.$download.'" class="btn btn-warning btn-sm mr-1">Télécharger</a>';

                return $btn;
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Rapport::TYPE_RAPPORT[$row->type] : '';
            });
            $table->editColumn('premiere_date', function ($row) {
                return $row->premiere_date ? $row->premiere_date : '';
            });
            $table->editColumn('deuxieme_date', function ($row) {
                return $row->deuxieme_date ? $row->deuxieme_date : '';
            });
            $table->editColumn('date_creation', function ($row) {
                return $row->date_creation ? $row->date_creation : '';
            });
            $table->editColumn('status', function ($row) {

                if($row->status == 'complet'){
                    return '<span class="badge bg-success text-white">'.Rapport::STATUS[$row->status].'</span>';
                }else{
                    return '<span class="badge bg- text-white">'.Rapport::STATUS[$row->status].'</span>';
                }

            });



            $table->rawColumns(['status','actions', 'placeholder']);

            return $table->make(true);
        }
        if($id == 'plomos'){
            return view('rapport.ShowRapportPlomos');
        }else if($id == 'kilometrage_chauffeur'){
            return view('rapport.ShowRapportChauffeurs');
        }else{
            return view('rapport.ShowRapportVehicles');
        }
    }

    public function download($id){

        $rapport = Rapport::findORFail($id);

        //return $rapport->rapport_file;
        foreach ($rapport->rapport_file as $media) {
            return $media;
        }


    }
}
