<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'client_id'    => 'required|exists:clients,id',
            'product' => 'required|string|min:2|max:100',
            'total' => 'required|numeric',
            'date' => 'required|date_format:d/m/Y|before:today',
        ];
    }
}
