<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonStoreRequest extends FormRequest
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
            'matricule' => 'required:|max:40',
            'categorie' => '',
            'nom' => 'required',
            'prenom' => 'required',
            'date_naiss' => 'required',
            'situation_familiale' => '',
            'nationalite' => '',
            'cin' => 'required',
            'nbre_enfant' => 'integer',
            'tele' => '',
            'sexe' => '',
            'nb_deduction' => 'integer',
            'transport' => '',
            'adress' => '',
            'ville' => '',
            'fonction' => 'required',
            'section' => '',
            'date_embauche' => '',
            'date_depart' => '',
            'salaire_base' => 'numeric',
            'taux_horaire' => 'numeric',
            'banque' => '',
            'N_Cmp_Banc' => '',
            'mode_reglement' => '',
            'prime_presentation' => 'numeric',
            'prime_panier' => 'numeric',
            'prime_logement' => 'numeric',
            'retraite' => '',
            'cnss' => '',
            'date_affiliation' => '',
        ];
    }
}
