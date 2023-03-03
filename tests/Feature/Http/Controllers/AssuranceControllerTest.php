<?php

namespace Tests\Feature\Http\Controllers;

use App\Assurance;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\HttpTestAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AssuranceController
 */
class AssuranceControllerTest extends TestCase
{
    use HttpTestAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $assurances = factory(Assurance::class, 3)->create();

        $response = $this->get(route('assurance.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AssuranceController::class,
            'store',
            \App\Http\Requests\AssuranceStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $date = $this->faker->date();
        $expiration = $this->faker->date();
        $assurance_international = $this->faker->date();
        $asseureur = $this->faker->word;
        $police = $this->faker->word;
        $vehicle_id = $this->faker->randomDigitNotNull;

        $response = $this->post(route('assurance.store'), [
            'date' => $date,
            'expiration' => $expiration,
            'assurance_international' => $assurance_international,
            'asseureur' => $asseureur,
            'police' => $police,
            'vehicle_id' => $vehicle_id,
        ]);

        $assurances = Assurance::query()
            ->where('date', $date)
            ->where('expiration', $expiration)
            ->where('assurance_international', $assurance_international)
            ->where('asseureur', $asseureur)
            ->where('police', $police)
            ->where('vehicle_id', $vehicle_id)
            ->get();
        $this->assertCount(1, $assurances);
        $assurance = $assurances->first();
    }
}
