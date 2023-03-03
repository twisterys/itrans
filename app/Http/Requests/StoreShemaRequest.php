<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreShemaRequest extends FormRequest
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
            'nom'           => 'required',
            'start_from'    => 'required',
            'prefix'        => 'required',
            'suffix'        => 'required',
            'template'      => '',
            'footer'        => '',
            'letterscount'  => 'required',
            'current'       => 'required',
            'type'          => 'required',
            'date'          => 'required'
        ];
    }
}
