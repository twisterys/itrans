<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFactureRequest extends FormRequest
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
            'reference',
            'montant_ht',
            'montant_ttc',
            'tax',
            'paiement_statut' => 'required',
            'facture_date' => 'required',
            'echeance_date' => 'required',      
            'client_id' => 'required',
            'created_by',
            'note',
        ];
    }
}
