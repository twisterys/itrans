<?php

namespace Tests\Feature\Http\Controllers;

use App\Taco;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\HttpTestAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TacoController
 */
class TacoControllerTest extends TestCase
{
    use HttpTestAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $tacos = factory(Taco::class, 3)->create();

        $response = $this->get(route('taco.index'));
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TacoController::class,
            'store',
            \App\Http\Requests\TacoStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_behaves_as_expected()
    {
        $ = $this->faker->word;

        $response = $this->post(route('taco.store'), [
            '' => $,
        ]);
    }
}
