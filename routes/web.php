<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
})->name('home');

Route::get('identity','TestController@index');
Route::get('enc/{key}','TestController@enc');

Auth::routes();

Route::redirect('index','home');
Route::view('expiration', 'expiration')->name('expiration');

Route::get('/afficherPublic/{id}', 'MagasinageController@showPublic');


// You can also use auth middleware to prevent unauthenticated users
Route::group(['middleware' => ['auth'] ], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/test', 'HomeController@test')->name('test');

    //Vehicle
    Route::resource('vehicle', 'VehicleController');

    //Assurance
    Route::resource('vehicle.assurance', 'AssuranceController');
    Route::get('Assurance/download/{id}','AssuranceController@dowload')->name('vehicle.assurance.download');

    //Visite Technique for vehicle
    Route::resource('vehicle.technicalVisit', 'TechnicalVisitController');
    Route::get('technicalVisit/download/{id}','TechnicalVisitController@dowload')->name('vehicle.technicalVisit.download');


    //Extinteur for vehicle
    Route::resource('vehicle.exctinteur', 'ExctinteurController');
    Route::get('exctinteur/download/{id}','ExctinteurController@dowload')->name('vehicle.exctinteur.download');




    //Disk for vehicle
    Route::resource('vehicle.taco', 'TacoController');
    Route::get('taco/download/{id}','TacoController@dowload')->name('vehicle.taco.download');



    Route::resource('import', 'ImportController');
    Route::resource('export', 'ExportController');
    Route::resource('national', 'NationalController');


    //Personnel
    Route::resource('person', 'PersonController');
    Route::post('person/addExternalPerson','PersonController@addExternal')->name('person.addExternalPerson');
    Route::post('person/media', 'PersonController@storeMedia')->name('person.storeMedia');


    //Type Vehicule
    Route::resource('TypeVehicle','TypeVehicleController');

    //Type Packaging
    Route::resource('TypePackaging','TypePackagingController');

    //Services
    Route::resource('service','ServiceController');


    //Type Frais
    Route::resource('TypeFrais','TypeFraisController');

    //Type Client
    Route::resource('TypeClient','TypeClientController');

    //Transporteur
    Route::resource('transporteur','TransporteurControleur');

    //Visite technique pour taco
    Route::resource('taco.visiteTechnique','VisiteTechnqueTacoController');
    Route::get('visiteTechnique/download/{id}','VisiteTechnqueTacoController@dowload')->name('taco.visiteTech.download');






    Route::resource('alert-setting', 'AlertSettingController');

    //Import Docs
    Route::post('import/media', 'ImportController@storeMedia')->name('import.storeMedia');
    Route::post('import/store_docs', 'ImportController@store_docs')->name('import.store_docs');
    Route::get('import/{id}/documents', 'ImportController@documents')->name('import.documents');

    Route::get('dossier/download/{import}','ImportController@download')->name('import.download');

    //Export Docs
    Route::post('export/store_docs', 'ExportController@store_docs')->name('export.store_docs');
    Route::get('export/{id}/documents', 'ExportController@documents')->name('export.documents');
    //National Docs
    Route::post('national/store_docs', 'NationalController@store_docs')->name('national.store_docs');
    Route::get('national/{id}/documents', 'NationalController@documents')->name('national.documents');

    Route::delete('document/{media}','ImportController@deleteDoc')->name('doc.delete');


    //Stations
    Route::resource('station','StationController');


    //Gasoil
    Route::resource('gasoil','GasoilController');

    //Depot
    Route::resource('depot','DepotController');


    //Magasinage
    Route::resource('magasinage','MagasinageController');
    Route::post('magasinage/media', 'MagasinageController@storeMedia')->name('magasinage.storeMedia');



    Route::get('magasinage/download/{magasinage}','MagasinageController@download')->name('magasinage.download');



    Route::post('vehicle/media', 'VehicleController@storeMedia')->name('vehicle.storeMedia');

    Route::post('assurance/media', 'AssuranceController@storeMedia')->name('assurance.storeMedia');
    Route::post('technicalVisit/media', 'TechnicalVisitController@storeMedia')->name('technicalVisit.storeMedia');
    Route::post('exctinteur/media', 'ExctinteurController@storeMedia')->name('exctinteur.storeMedia');
    Route::post('taco/media', 'ExctinteurController@storeMedia')->name('taco.storeMedia');
    Route::post('visitTechTaco/media', 'VisiteTechnqueTacoController@storeMedia')->name('visitTechTaco.storeMedia');


    Route::resource('dossier', 'DossierController');


    //Rapport
    Route::get('rapport/index','RapportController@index')->name('rapport.index');
    Route::get('rapport/kilometrage','RapportController@kilometrage')->name('rapport.kilometrage');
    Route::get('rapport/{id}','RapportController@typeRapport')->name('rapport.type');
    Route::post('rapport/kilometrage','RapportController@calculKilometrage')->name('rapport.calculKilometrage');
    Route::get('rapport/dowload/{id}','RapportController@download')->name('rapport.download');




    Route::get('parametrage/expiration','ParametrageController@edit')->name('parametrage.expiration');
    Route::put('parametrage/expiration/{parametrage}','ParametrageController@update')->name('parametrage.editExpiration');


    //Plomos
    Route::resource('plomos','PlomoController');
    Route::put('plomos/sortant/{id}','PlomoController@sortant');
    Route::get('plomo/rapport','PlomoController@rapport')->name('plomos.rapport');


    //Utilisateur
    Route::resource('user','UserController');


    //Client
    Route::resource('client','ClientController');

    //Transitaire
    Route::resource('transitaire','TransitaireController');

    //Vente
    Route::resource('vente','VenteController');
    Route::post('vent/facturer_tous','VenteController@facturer_tous')->name('vente.facturer_tous');

    //Facturation
    Route::resource('facture','FactureController');

    //ShemaFacturation
    Route::resource('shema','ShemaController');


    //Role
    Route::resource('role','RoleController');


    //Permission
    Route::resource('permission','PermissionController');

    //AssuranceMarchandise

    Route::resource('assuranceMarchandise','AssuranceMarchandiseController');
    Route::post('assuranceMarchandise/media', 'AssuranceMarchandiseController@storeMedia')->name('assuranceMarchandise.storeMedia');



    //AssuranceTravail
    Route::resource('assuranceTravail','AssuranceTravailController');
    Route::post('assuranceTravail/media', 'AssuranceTravailController@storeMedia')->name('assuranceTravail.storeMedia');

    //GenralFrai
    Route::resource('generalFrais','GeneralFraisController');



});

Route::get('{any}', function () {
    return view('exceptions.404');
})->name('PageNotFound');




