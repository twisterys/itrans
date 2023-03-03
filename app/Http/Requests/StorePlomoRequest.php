<?php

namespace App\Http\Requests;

use App\Rules\PlomosRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePlomoRequest extends FormRequest
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
            'from' => 'required|integer|numeric|gt:0',
            'to' => ["required","integer","numeric","gt:0",new PlomosRule($this->from)],
        ];
    }
}
