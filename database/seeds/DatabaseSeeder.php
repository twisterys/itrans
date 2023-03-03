<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('parametrages')->insert([
//           'expiration' => 10,
//           'plomos_expiration' => 10,
//        ]);
//        DB::table('type_frais')->insert(
//            array(
//            [
//                'name' => 'Frais peage','active' => 1
//            ],
//            [
//                'name' => 'Frais auto','active' => 1
//            ],
//            )
//
//        );
//        DB::table('type_vehicles')->insert(
//            array(
//            [
//                'name' => 'Camion','active' => 1
//            ],
//            [
//                'name' => 'Fourgon','active' => 1
//            ],
//            [
//                'name' => 'Voiture','active' => 1
//            ],
//            )
//        );
//        DB::table('type_clients')->insert(
//            array(
//            [
//                'name' => 'Personne Physique','active' => 1
//            ]
//            )
//        );
//        DB::table('depots')->insert(
//            array(
//            [
//                'nom' => 'depot1','ville' => 'Tanger'
//            ],
//            [
//                'nom' => 'depot2','ville' => 'rabat'
//            ],
//            )
//
//        );
//        DB::table('stations')->insert(
//            array(
//            [
//                'nom' => 'Shell','ville' => 'tanger'
//            ],
//            [
//                'nom' => 'Shell','ville' => 'Rabat'
//            ],
//            )
//
//        );

        DB::table('general_frais')->insert(
            array(
            [
                'type_frais' => 'maroc',
            ],
            [
                'type_frais' => 'etranger',
            ],
        ));

        DB::table('permissions')->insert(
            array(
            [
                'name' => 'ajouter_user','guard_name' => 'web'
            ],[
                'name' => 'modifier_user','guard_name' => 'web'
            ],
            [
                'name' => 'supprimer_user','guard_name' => 'web'
            ],
            [
                'name' => 'view_user','guard_name' => 'web'
            ],
            [
                'name' => 'ajouter_vehicle','guard_name' => 'web'
            ],
            [
                'name' => 'modifier_vehicle','guard_name' => 'web'
            ],
            [
                'name' => 'supprimer_vehicle','guard_name' => 'web'
            ],
            [
                'name' => 'view_vehicle','guard_name' => 'web'
            ],
            [
                'name' => 'ajouter_personel','guard_name' => 'web'
            ],
            [
                'name' => 'modifier_personel','guard_name' => 'web'
            ],
            [
                'name' => 'supprimer_personel','guard_name' => 'web'
            ],
            [
                'name' => 'view_personel','guard_name' => 'web'
            ],
            [
                'name' => 'ajouter_dossier','guard_name' => 'web'
            ],
            [
                'name' => 'modifier_dossier','guard_name' => 'web'
            ],
            [
                'name' => 'supprimer_dossier','guard_name' => 'web'
            ],
            [
                'name' => 'view_dossier','guard_name' => 'web'
            ],
            [
                'name' => 'ajouter_gasoil','guard_name' => 'web'
            ],
            [
                'name' => 'modifier_gasoil','guard_name' => 'web'
            ],
            [
                'name' => 'supprimer_gasoil','guard_name' => 'web'
            ],
            [
                'name' => 'view_gasoil','guard_name' => 'web'
            ],
            [
                'name' => 'ajouter_magasinage','guard_name' => 'web'
            ],
            [
                'name' => 'modifier_magasinage','guard_name' => 'web'
            ],
            [
                'name' => 'supprimer_magasinage','guard_name' => 'web'
            ],
            [
                'name' => 'view_magasinage','guard_name' => 'web'
            ],
            [
                'name' => 'view_rapport','guard_name' => 'web'
            ],
            [
                'name' => 'ajouter_parametre','guard_name' => 'web'
            ],
            [
                'name' => 'modifier_parametre','guard_name' => 'web'
            ],
            [
                'name' => 'supprimer_parametre','guard_name' => 'web'
            ],
            [
                'name' => 'view_parametre','guard_name' => 'web'
            ],
            [
                'name' => 'view_dashboard','guard_name' => 'web'
            ],
            
            )
            
        );
        
        $this->call(UserSeeder::class);
        
       
                    
    }
}
