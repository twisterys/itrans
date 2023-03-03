<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewVehicle;
use App\Mail\ReviewVehicle;
use App\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use JMac\Testing\Traits\HttpTestAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VehicleController
 */
class VehicleControllerTest extends TestCase
{
    use HttpTestAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $vehicles = factory(Vehicle::class, 3)->create();

        $response = $this->get(route('vehicle.index'));

        $response->assertOk();
        $response->assertViewIs('vehicle.index');
        $response->assertViewHas('vehicles');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VehicleController::class,
            'store',
            \App\Http\Requests\VehicleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $numero = $this->faker->word;
        $marque = $this->faker->word;
        $modele = $this->faker->word;
        $genre = $this->faker->word;
        $annee = $this->faker->date();
        $color = $this->faker->word;
        $num_chassis = $this->faker->randomNumber();
        $carburant = $this->faker->word;
        $puissance_fiscale = $this->faker->randomNumber();
        $nbr_cylindre = $this->faker->randomNumber();
        $nbr_place = $this->faker->randomNumber();
        $P.A.T.C = $this->faker->word;
        $P.A.V = $this->faker->word;
        $id_chronotachygraphe = $this->faker->randomNumber();
        $carte_grise = $this->faker->word;
        $num_inscription = $this->faker->randomNumber();

        Mail::fake();
        Event::fake();

        $response = $this->post(route('vehicle.store'), [
            'numero' => $numero,
            'marque' => $marque,
            'modele' => $modele,
            'genre' => $genre,
            'annee' => $annee,
            'color' => $color,
            'num_chassis' => $num_chassis,
            'carburant' => $carburant,
            'puissance_fiscale' => $puissance_fiscale,
            'nbr_cylindre' => $nbr_cylindre,
            'nbr_place' => $nbr_place,
            'P.A.T.C' => $P.A.T.C,
            'P.A.V' => $P.A.V,
            'id_chronotachygraphe' => $id_chronotachygraphe,
            'carte_grise' => $carte_grise,
            'num_inscription' => $num_inscription,
        ]);

        $vehicles = Vehicle::query()
            ->where('numero', $numero)
            ->where('marque', $marque)
            ->where('modele', $modele)
            ->where('genre', $genre)
            ->where('annee', $annee)
            ->where('color', $color)
            ->where('num_chassis', $num_chassis)
            ->where('carburant', $carburant)
            ->where('puissance_fiscale', $puissance_fiscale)
            ->where('nbr_cylindre', $nbr_cylindre)
            ->where('nbr_place', $nbr_place)
            ->where('P.A.T.C', $P.A.T.C)
            ->where('P.A.V', $P.A.V)
            ->where('id_chronotachygraphe', $id_chronotachygraphe)
            ->where('carte_grise', $carte_grise)
            ->where('num_inscription', $num_inscription)
            ->get();
        $this->assertCount(1, $vehicles);
        $vehicle = $vehicles->first();

        $response->assertRedirect(route('vehicle.index'));

        Mail::assertSent(ReviewVehicle::class, function ($mail) use ($vehicle) {
            return $mail->vehicle->is($vehicle);
        });
        Event::assertDispatched(NewVehicle::class, function ($event) use ($vehicle) {
            return $event->vehicle->is($vehicle);
        });
    }
}
