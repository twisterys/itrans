<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExctinteurStoreRequest extends FormRequest
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
            'client' => 'required|string',
            'date_last_control' => 'required|date',
            'date_next_control' => 'required|date',
            'vehicle_id' => 'required|integer|exists:vehicles,id',
            // 'file' => 'required|mimes:pdf'
        ];
    }
}
