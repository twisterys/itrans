<?php

namespace Tests\Feature\Http\Controllers;

use App\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\HttpTestAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PersonController
 */
class PersonControllerTest extends TestCase
{
    use HttpTestAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $people = factory(Person::class, 3)->create();

        $response = $this->get(route('person.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PersonController::class,
            'store',
            \App\Http\Requests\PersonStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_behaves_as_expected()
    {
        $matricule = $this->faker->word;
        $categorie = $this->faker->word;
        $nom = $this->faker->word;
        $prenom = $this->faker->word;
        $date_naiss = $this->faker->date();
        $situation_familiale = $this->faker->word;
        $nationalite = $this->faker->word;
        $cin = $this->faker->word;
        $nbre_enfant = $this->faker->randomNumber();
        $tele = $this->faker->word;
        $sexe = $this->faker->word;
        $nb_deduction = $this->faker->randomNumber();
        $transport = $this->faker->word;
        $adress = $this->faker->word;
        $ville = $this->faker->word;
        $fonction = $this->faker->word;
        $section = $this->faker->word;
        $date_embauche = $this->faker->date();
        $date_depart = $this->faker->date();
        $salaire_base = $this->faker->;
        $salaire_horaire = $this->faker->;
        $banque = $this->faker->word;
        $N_Cmp_Banc = $this->faker->word;
        $mode_reglement = $this->faker->word;
        $prime_presentation = $this->faker->;
        $prime_panier = $this->faker->;
        $prime_logement = $this->faker->;
        $retraite = $this->faker->word;
        $cnss = $this->faker->word;
        $date_affiliation = $this->faker->date();

        $response = $this->post(route('person.store'), [
            'matricule' => $matricule,
            'categorie' => $categorie,
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naiss' => $date_naiss,
            'situation_familiale' => $situation_familiale,
            'nationalite' => $nationalite,
            'cin' => $cin,
            'nbre_enfant' => $nbre_enfant,
            'tele' => $tele,
            'sexe' => $sexe,
            'nb_deduction' => $nb_deduction,
            'transport' => $transport,
            'adress' => $adress,
            'ville' => $ville,
            'fonction' => $fonction,
            'section' => $section,
            'date_embauche' => $date_embauche,
            'date_depart' => $date_depart,
            'salaire_base' => $salaire_base,
            'salaire_horaire' => $salaire_horaire,
            'banque' => $banque,
            'N_Cmp_Banc' => $N_Cmp_Banc,
            'mode_reglement' => $mode_reglement,
            'prime_presentation' => $prime_presentation,
            'prime_panier' => $prime_panier,
            'prime_logement' => $prime_logement,
            'retraite' => $retraite,
            'cnss' => $cnss,
            'date_affiliation' => $date_affiliation,
        ]);
    }
}
