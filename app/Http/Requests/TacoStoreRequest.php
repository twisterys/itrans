<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TacoStoreRequest extends FormRequest
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
            'num_homologation' => 'required|string|max:30',
            'marque' => 'required|string|max:30',
            'num_serie' => 'required|string|max:30',
            'date_validation' => 'required|date',
            'date_expiration' => 'required|date',
            // 'file' => 'required|mimes:pdf'
        ];
    }
}
