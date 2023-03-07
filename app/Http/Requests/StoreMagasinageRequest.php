<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMagasinageRequest extends FormRequest
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
            'client_id' => 'required',
            'date_entree'   => 'required',
            'date_sortie'   => '',
            'mat_entree'    => 'required',
            'mat_sortie'    => '',
            'depot_id'  => 'required',
            'user_id' => 'required',
            //'num_bon' => 'required',
            'gross_weight' => '',
            'net_weight' =>'',
            'number'=>'',

        ];
    }
}
