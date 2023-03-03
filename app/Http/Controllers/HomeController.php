<?php

namespace App\Http\Controllers;

use App\Assurance;
use App\AssuranceMarchandise;
use App\AssuranceTravail;
use App\Dossier;
use App\DossierPlomos;
use App\TechnicalVisit;
use App\Vehicle;
use App\Exctinteur;
use App\Export;
use App\Import;
use App\Magasinage;
use App\Parametrage;
use App\Plomo;
use App\Taco;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $alerts = array();
        $current_date=Carbon::now()->format('Y-m-d');
        $parametrage = Parametrage::first('expiration');

        $vehicules = Vehicle::with([
        'assurances' => function($q){
            $q->orderby('expiration','desc')->select('expiration','vehicle_id');
        },
        'technicalVisits' => function($q){
            $q->orderby('date_next_visit','desc')->select('date_next_visit','vehicle_id');
        },
        'tacos' => function($q){
            $q->orderby('date_expiration','desc')->select('date_expiration','vehicle_id','id');
            $q->with(['visitTechnique' => function($q2){
                $q2->orderby('date_next_visit','desc')->select('date_next_visit','taco_id');
            }]);
        },
        'extinteurs' => function($q){
            $q->orderby('date_next_control','desc')->select('date_next_control','vehicle_id');
        }
        ])
        ->get();

        foreach ($vehicules as  $v) {
            $var = array();
            $date_valid_veh_diffDays = Carbon::parse($current_date)->diffInDays($v->date_debut_validite,false);
            if($date_valid_veh_diffDays <= $parametrage->expiration && $date_valid_veh_diffDays >= -10){
                $var['rest_days'] = $date_valid_veh_diffDays;
                $var['type_alert'] = 'Date Validité de véhicule';
                $var['genre'] = $v->genre;
                $var['matricule_vehicle'] = $v->N_immatriculation;
            }
            array_push($alerts,$var);
            foreach ($v->assurances as $value) {
                $var1 = array();
                $assurance_diffDays =Carbon::parse($current_date)->diffInDays($value->expiration,false);
                if($assurance_diffDays <= $parametrage->expiration && $assurance_diffDays >= -10){
                    $var1['rest_days'] = $assurance_diffDays;
                    $var1['type_alert'] = 'Assurance';
                    $var1['genre'] = $v->genre;
                    $var1['matricule_vehicle'] = $v->N_immatriculation;
                }
                array_push($alerts,$var1);
                goto cIterator1;
            }
            cIterator1: {
            foreach ($v->technicalVisits as $value) {
                $var2 = array();
                $technical_visit_diffDays =Carbon::parse($current_date)->diffInDays($value->date_next_visit,false);
                if($technical_visit_diffDays <= $parametrage->expiration && $technical_visit_diffDays >= -10){
                    $var2['rest_days'] = $technical_visit_diffDays;
                    $var2['type_alert'] = 'Visite technique';
                    $var2['genre'] = $v->genre;
                    $var2['matricule_vehicle'] = $v->N_immatriculation;
                }
                array_push($alerts,$var2);
                goto cIterator2;
            }
            }
            cIterator2: {
            foreach ($v->tacos as $value) {
                $var3 = array();
                $taco_diffDays =Carbon::parse($current_date)->diffInDays($value->date_expiration,false);
                if($taco_diffDays <= $parametrage->expiration && $taco_diffDays >= -10){
                    $var3['rest_days'] = $taco_diffDays;
                    $var3['type_alert'] = 'Disque';
                    $var3['genre'] = $v->genre;
                    $var3['matricule_vehicle'] = $v->N_immatriculation;
                }
                array_push($alerts,$var3);
                foreach ($value->visitTechnique as $val) {
                    $var4 = array();
                    $vis_tech_taco_diffDays =Carbon::parse($current_date)->diffInDays($val->date_next_visit,false);
                    if($vis_tech_taco_diffDays <= $parametrage->expiration && $vis_tech_taco_diffDays >= -10){
                        $var4['rest_days'] = $vis_tech_taco_diffDays;
                        $var4['type_alert'] = 'Visite Technique de Disque';
                        $var4['genre'] = $v->genre;
                        $var4['matricule_vehicle'] = $v->N_immatriculation;
                    }
                    array_push($alerts,$var4);
                    goto cIterator3;
                }
            }
            }
            cIterator3: {
            foreach ($v->extinteurs as  $value) {
                $var5 = array();
                $exctinteur_diffDays =Carbon::parse($current_date)->diffInDays($value->date_next_control,false);
                if($exctinteur_diffDays <= $parametrage->expiration && $exctinteur_diffDays >= -10){
                    $var5['rest_days'] = $exctinteur_diffDays;
                    $var5['type_alert'] = 'Extinteur';
                    $var5['genre'] = $v->genre;
                    $var5['matricule_vehicle'] = $v->N_immatriculation;
                }
                array_push($alerts,$var5);
                goto cIterator4;
            }
            }
            cIterator4 : {

            }
        }

        $assuranceTravail = AssuranceTravail::latest()->first();
        if(!is_null($assuranceTravail)){

            $assuranceTravail_diffDays =Carbon::parse($current_date)->diffInDays($assuranceTravail->expiration,false);
            if($assuranceTravail_diffDays <= $parametrage->expiration && $assuranceTravail_diffDays >= -10){
                $var6 = array();
                $var6['rest_days'] = $assuranceTravail_diffDays;
                $var6['type_alert'] = 'Assurance de travail';
                $var6['genre'] = '';
                $var6['matricule_vehicle'] = '';
                array_push($alerts,$var6);
            }
        }


        $assuranceMarchandise = AssuranceMarchandise::latest()->first();
        if(!is_null($assuranceMarchandise)) {
            $assuranceMarchandise_diffDays = Carbon::parse($current_date)->diffInDays($assuranceMarchandise->expiration, false);
            if ($assuranceMarchandise_diffDays <= $parametrage->expiration && $assuranceMarchandise_diffDays >= -10) {
                $var7 = array();
                $var7['rest_days'] = $assuranceMarchandise_diffDays;
                $var7['type_alert'] = 'Assurance de marchandise';
                $var7['genre'] = '';
                $var7['matricule_vehicle'] = '';
                array_push($alerts, $var7);
            }
        }

        $restPlomos = Plomo::where('used_at',null)->count();
        $expiration = Parametrage::first('plomos_expiration');


        $nbVehicles = Vehicle::count();
        $nbImports = Dossier::where('type','import')->count();
        $nbExports = Dossier::where('type','export')->count();
        $nbNational = Dossier::where('type','national')->count();

        $nbMagasin = 0;
        if(auth()->user()->is_admin){
            $nbMagasin = Magasinage::all()->count();
        }elseif (auth()->user()->magasinages()) {
            $nbMagasin = Magasinage::where('user_id',auth()->user()->id)->count();
        }else{
            $nbMagasin = 0;
        }

        //return $nbMagasin;


        return view('dashboard',compact('alerts','nbVehicles','nbImports','nbExports','nbNational','restPlomos','expiration','nbMagasin'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
