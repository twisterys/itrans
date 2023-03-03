<?php

namespace Tests\Feature\Http\Controllers;

use App\Import;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\HttpTestAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ImportController
 */
class ImportControllerTest extends TestCase
{
    use HttpTestAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $imports = factory(Import::class, 3)->create();

        $response = $this->get(route('import.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImportController::class,
            'store',
            \App\Http\Requests\ImportStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_behaves_as_expected()
    {
        $manifeste = $this->faker->word;
        $num_EORI = $this->faker->randomNumber();
        $date = $this->faker->date();
        $num_connaissement = $this->faker->randomNumber();
        $driver = $this->faker->word;
        $mat_camion = $this->faker->word;
        $mat_remorque = $this->faker->word;
        $mat_contenaire = $this->faker->word;
        $compagnie = $this->faker->word;
        $navire = $this->faker->word;
        $provenance = $this->faker->word;
        $destination = $this->faker->word;
        $date_arrivée = $this->faker->date();
        $date_sortie = $this->faker->date();
        $observation = $this->faker->word;
        $tarre = $this->faker->randomNumber();
        $poid_brut = $this->faker->randomNumber();
        $nbr_colis = $this->faker->randomNumber();
        $frais_peage = $this->faker->randomNumber();
        $frais_TMSA = $this->faker->randomNumber();
        $montant_fret = $this->faker->randomNumber();
        $devise = $this->faker->randomNumber();
        $cours = $this->faker->word;
        $type = $this->faker->word;

        $response = $this->post(route('import.store'), [
            'manifeste' => $manifeste,
            'num_EORI' => $num_EORI,
            'date' => $date,
            'num_connaissement' => $num_connaissement,
            'driver' => $driver,
            'mat_camion' => $mat_camion,
            'mat_remorque' => $mat_remorque,
            'mat_contenaire' => $mat_contenaire,
            'compagnie' => $compagnie,
            'navire' => $navire,
            'provenance' => $provenance,
            'destination' => $destination,
            'date_arrivée' => $date_arrivée,
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
