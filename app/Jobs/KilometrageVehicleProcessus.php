<?php

namespace App\Jobs;

use App\Dossier;
use App\Exports\KilometrageExport;
use App\Rapport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class KilometrageVehicleProcessus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $first_date,$second_date,$user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($first_date,$second_date,$user_id)
    {
        
        $this->first_date = $first_date;
        $this->second_date = $second_date;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $rapports = Dossier::join('dossier_vehicle','dossier_vehicle.dossier_id','=','dossiers.id')
        ->join('vehicles','vehicles.id','=','dossier_vehicle.vehicle_id')
        ->join('type_vehicles','type_vehicles.id','=','dossier_vehicle.typeVehicle_id')
        ->whereBetween('date',[$this->first_date,$this->second_date])
        ->select(['vehicles.N_immatriculation','type_vehicles.name'])
        ->selectRaw('sum(kilometrage) as sum_kilometrage')
        ->selectRaw('sum(nb_jour_etranger) as nbJour_etranger')
        ->selectRaw('sum(nb_jour_maroc) as nbJour_maroc')
        ->selectRaw('sum(dossiers.type="import") as nb_import')
        ->selectRaw('sum(dossiers.type="export") as nb_export')
        ->selectRaw('sum(dossiers.type="national") as nb_national')
        ->groupBy(['vehicles.N_immatriculation','type_vehicles.id'])
        ->get();

       
        $rapport = New Rapport();
        $rapport->type          = 'kilometrage_vehicle';
        $rapport->premiere_date = $this->first_date;
        $rapport->deuxieme_date = $this->second_date;
        $rapport->date_creation = Carbon::now();
        $rapport->user_id       = $this->user_id;
        $rapport->save();
        

        $excel = Excel::store(new KilometrageExport($rapports), $rapport->id.'.xlsx','public');
        
        if($excel){
            $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($rapport->id.'.xlsx');
            $rapport->addMedia($path)->toMediaCollection('rapport_file');
            $rapport->update([
                'status' => 'complet',
            ]);
        }else{
            $rapport->update([
                'status' => 'erreur',
            ]);
        }

    }
}
