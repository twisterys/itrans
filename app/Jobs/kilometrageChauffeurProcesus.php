<?php

namespace App\Jobs;

use App\Dossier;
use App\Exports\KilometrageChauffeurExport;
use App\Rapport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class kilometrageChauffeurProcesus implements ShouldQueue
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
        $rapports = Dossier::Join('dossier_chauffeurs','dossier_chauffeurs.dossier_id','=','dossiers.id')
        ->join('people','people.id','=','dossier_chauffeurs.chauffeur_id')
        ->join('personal_expenses','personal_expenses.dossier_id','=','dossiers.id')
        ->join('type_frais','type_frais.id','=','personal_expenses.typeFrais_id')
        ->join('general_frais','general_frais.id','=','type_frais.general_frais_id')
        ->whereBetween('date',[$this->first_date,$this->second_date])
        ->select(['people.nom','people.prenom','people.cin'])
        ->selectRaw('sum(kilometrage) as sum_kilometrage')
        ->selectRaw('sum(nb_jour_etranger) as nbJour_etranger')
        ->selectRaw('sum(nb_jour_maroc) as nbJour_maroc')
        ->selectRaw('sum(case when dossiers.type = "import" and (general_frais.type_frais = "maroc") then 1 else 0 end) as nb_import')
        ->selectRaw('sum(case when dossiers.type = "export" and (general_frais.type_frais = "maroc") then 1 else 0 end) as nb_export')
        ->selectRaw('sum(case when dossiers.type = "national" and (general_frais.type_frais = "maroc") then 1 else 0 end) as nb_national')

        //->selectRaw("count(dossiers.type = 'export' ) as nb_export")
        //->selectRaw("count(dossiers.type = 'national') as nb_national")
       
        ->selectRaw('sum(case when general_frais.type_frais = "maroc" then personal_expenses.montant end) as frais_maroc')
        ->selectRaw('sum(case when general_frais.type_frais = "etranger" then personal_expenses.montant end) as frais_etranger')
        
        ->groupBy(['people.id','personal_expenses.devise'])
        ->get();
        
        $rapport = New Rapport();
        $rapport->type          = 'kilometrage_chauffeur';
        $rapport->premiere_date = $this->first_date;
        $rapport->deuxieme_date = $this->second_date;
        $rapport->date_creation = Carbon::now();
        $rapport->user_id       = $this->user_id;
        $rapport->save();
        

        $excel = Excel::store(new KilometrageChauffeurExport($rapports), $rapport->id.'.xlsx','public');
        
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
