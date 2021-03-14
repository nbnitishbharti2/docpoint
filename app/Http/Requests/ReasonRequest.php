<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class ReasonRequest extends FormRequest
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
            'speciality_id' => 'required|integer',
            'name' => 'required|min:4|max:40',
            'status' => 'required|string',
        ];
    }

    public function messages()
    {
        return [            
            
        ];
    }
}
