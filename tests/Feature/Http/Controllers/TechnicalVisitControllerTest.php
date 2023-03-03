<?php

namespace Tests\Feature\Http\Controllers;

use App\TechnicalVisit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\HttpTestAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TechnicalVisitController
 */
class TechnicalVisitControllerTest extends TestCase
{
    use HttpTestAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $technicalVisits = factory(TechnicalVisit::class, 3)->create();

        $response = $this->get(route('technicalvisit.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TechnicalVisitController::class,
            'store',
            \App\Http\Requests\TechnicalVisitStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_behaves_as_expected()
    {
        $ref = $this->faker->date();
        $date_last_visit = $this->faker->date();
        $date_next_visit = $this->faker->date();
        $visit_disque = $this->faker->word;
        $vignette = $this->faker->word;
        $vehicle_id = $this->faker->randomDigitNotNull;

        $response = $this->post(route('technicalvisit.store'), [
            'ref' => $ref,
            'date_last_visit' => $date_last_visit,
            'date_next_visit' => $date_next_visit,
            'visit_disque' => $visit_disque,
            'vignette' => $vignette,
            'vehicle_id' => $vehicle_id,
        ]);
    }
}
