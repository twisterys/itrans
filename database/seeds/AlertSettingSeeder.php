<?php

use App\AlertSetting;
use Illuminate\Database\Seeder;

class AlertSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $alerts = [
            [
                'id'    => 1,
                'name' => 'Alert Assurance',
                'label' => 'assurance_alert',
            ],
            [
                'id'    => 2,
                'name' => 'Alert Carte verte / Assurance internationale',
                'label' => 'green_card_alert',
            ],
            [
                'id'    => 4,
                'name' => 'Alert Visite technique',
                'label' => 'technical_visit_alert',
            ],
            [
                'id'    => 5,
                'name' => 'Alert Visite technique disque',
                'label' => 'technical_visit_disque_alert',
            ],
            [
                'id'    => 6,
                'name' => 'Alert Exctinteur',
                'label' => 'exctinteur_alert',
            ]

        ];

        AlertSetting::insert($alerts);
    }
}
