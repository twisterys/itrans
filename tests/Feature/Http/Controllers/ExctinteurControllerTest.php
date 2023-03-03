<?php

namespace Tests\Feature\Http\Controllers;

use App\Exctinteur;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\HttpTestAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ExctinteurController
 */
class ExctinteurControllerTest extends TestCase
{
    use HttpTestAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $exctinteurs = factory(Exctinteur::class, 3)->create();

        $response = $this->get(route('exctinteur.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ExctinteurController::class,
            'store',
            \App\Http\Requests\ExctinteurStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_behaves_as_expected()
    {
        $client = $this->faker->word;
        $type_extinteur = $this->faker->word;
        $poids = $this->faker->randomNumber();
        $date_last_control = $this->faker->date();
        $date_next_control = $this->faker->date();
        $vehicle_id = $this->faker->randomDigitNotNull;

        $response = $this->post(route('exctinteur.store'), [
            'client' => $client,
            'type_extinteur' => $type_extinteur,
            'poids' => $poids,
            'date_last_control' => $date_last_control,
            'date_next_control' => $date_next_control,
            'vehicle_id' => $vehicle_id,
        ]);
    }
}
