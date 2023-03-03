<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssuranceStoreRequest extends FormRequest
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
            'type' => 'required',
            'date' => 'required|date',
            'expiration' => 'required|date',
            'assureur' => 'required|max:40',
            'police' => 'required|max:40',
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            // 'file' => 'required|mimes:pdf'
        ];
    }
}
