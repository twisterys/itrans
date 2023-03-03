<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p = new \App\Parametrage() ;
        $p->expiration = 10 ;
        $p->plomos_expiration = 10 ;
        $p->save() ;
    }
}
