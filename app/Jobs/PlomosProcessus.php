<?php

namespace App\Jobs;

use App\Exports\PlomosExport;
use App\Plomo;
use App\Rapport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PlomosProcessus implements ShouldQueue
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
        //$this->plomos = $plomos;
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $plomos = Plomo::leftJoin('dossiers','dossiers.id','=','plomos.havePlomos_id')
        ->leftJoin('dossier_items','dossier_items.dossier_id','=','dossiers.id')
        ->leftJoin('magasinages','magasinages.id','=','plomos.havePlomos_id')
        ->whereBetween('plomos.created_at',[$this->first_date,$this->second_date])
        ->select(['plomos.num_serie','defaillante','traiter_a','havePlomos_type','dossier_items.dum'])
        ->groupBy(['plomos.id','plomos.num_serie'])
        ->where('used_at','!=',null)
        ->orWhere('defaillante',1)
        ->orWhere('traiter_a','!=',null)
        ->get();

        $rest_plomos = Plomo::where('used_at',null)->where('defaillante',0)->where('traiter_a',null)->count();
        //dd($plomos);
        $rapports = array();
        foreach ($plomos as $plomo) {
            $array = array();
                $array['plomo'] = $plomo->num_serie;
            if($plomo->defaillante == 1){
                $array['dum'] = 'Defaillante';
            }else if($plomo->traiter_a != null){
                $array['dum'] = 'Preter a :'.$plomo->traiter_a;
            }else if($plomo->havePlomos_type == 'App\Magasinage'){
                $array['dum'] = 'Magasinage';
            }else{
                $array['dum'] = 'Dossier';
            }
           array_push($rapports,$array);
          
        }   
        
        


        $rapport = New Rapport();
        $rapport->type          = 'plomos';
        $rapport->premiere_date = $this->first_date;
        $rapport->deuxieme_date = $this->second_date;
        $rapport->date_creation = Carbon::now();
        $rapport->user_id       = $this->user_id;
        $rapport->save();
        

        $excel = Excel::store(new PlomosExport($rapports,$rest_plomos), $rapport->id.'.xlsx','public');
        
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
