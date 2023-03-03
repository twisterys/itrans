<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleStoreRequest extends FormRequest
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
            'N_immatriculation' => 'required|string|max:30',
            'date_pre_mise_circul'  => 'required|date',
            'date_m_c_maroc'    => 'required|date',
            'date_mutation' => 'required|date',
            'date_debut_validite'   => '',
            'proprietaire'  => 'required|string|max:40',
            'marque'    => 'required|string|max:30',
            'type'  => 'required|string|max:30',
            'genre' => 'required|string',
            'modele'    => 'string|max:30',
            'type_carburant'    => 'required|string|max:40',
            'num_chassis'   => 'required|string',
            'nbr_cylindre'  => 'required|integer',
            'puissance_fiscale' => 'required|integer',
            'P_T_A_C'   => 'required|integer',
            'poids_a_vide'  => 'required|integer',
            'P_T_M_C_T' => '',
            // 'file' => 'required|mimes:pdf'
        ];
    }
}
