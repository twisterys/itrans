<?php

namespace Tests\Feature\Http\Controllers;

use App\National;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\HttpTestAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NationalController
 */
class NationalControllerTest extends TestCase
{
    use HttpTestAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $nationals = factory(National::class, 3)->create();

        $response = $this->get(route('national.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NationalController::class,
            'store',
            \App\Http\Requests\NationalStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_behaves_as_expected()
    {
        $num_EORI = $this->faker->randomNumber();
        $date = $this->faker->date();
        $driver = $this->faker->word;
        $mat_camion = $this->faker->word;
        $mat_remorque = $this->faker->word;
        $mat_contenaire = $this->faker->word;
        $compagnie = $this->faker->word;
        $navire = $this->faker->word;
        $provenance = $this->faker->word;
        $destination = $this->faker->word;
        $date_arrive = $this->faker->date();
        $date_sortie = $this->faker->date();
        $observation = $this->faker->word;
        $tarre = $this->faker->;
        $poid_brut = $this->faker->;
        $nbr_colis = $this->faker->randomNumber();
        $frais_peage = $this->faker->;
        $frais_TMSA = $this->faker->;
        $montant_fret = $this->faker->;
        $devise = $this->faker->;
        $cours = $this->faker->word;
        $type = $this->faker->word;

        $response = $this->post(route('national.store'), [
            'num_EORI' => $num_EORI,
            'date' => $date,
            'driver' => $driver,
            'mat_camion' => $mat_camion,
            'mat_remorque' => $mat_remorque,
            'mat_contenaire' => $mat_contenaire,
            'compagnie' => $compagnie,
            'navire' => $navire,
            'provenance' => $provenance,
            'destination' => $destination,
            'date_arrive' => $date_arrive,
            'date_sortie' => $date_sortie,
            'observation' => $observation,
            'tarre' => $tarre,
            'poid_brut' => $poid_brut,
            'nbr_colis' => $nbr_colis,
            'frais_peage' => $frais_peage,
            'frais_TMSA' => $frais_TMSA,
            'montant_fret' => $montant_fret,
            'devise' => $devise,
            'cours' => $cours,
            'type' => $type,
        ]);
    }
}
