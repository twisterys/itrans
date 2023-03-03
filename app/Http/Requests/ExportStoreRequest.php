<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportStoreRequest extends FormRequest
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
            'compagnie' => '',
            'navire' => '',
            'provenance' => '',
            'destination' => '',
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
