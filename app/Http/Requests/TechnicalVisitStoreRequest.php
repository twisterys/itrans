<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicalVisitStoreRequest extends FormRequest
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
            'ref' => '',
            'date_next_visit' => 'required|date',
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            // 'file' => 'required|mimes:pdf'
        ];
    }
}
