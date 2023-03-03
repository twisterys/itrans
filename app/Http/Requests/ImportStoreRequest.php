<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date',
            'num_connaissement' => 'required|integer',
            'compagnie' => 'max:30',
            'navire' => 'max:30',
            'provenance' => 'max:30',
            'destination' => 'max:30',
            'date_arrive' => '',
            'date_sortie' => '',
            'tarre' => '',
            'poid_brut' => '',
            'nbr_colis' => '',
            'type_chargement' => '',
            'kilometrage' => '',

        ];
    }
}
