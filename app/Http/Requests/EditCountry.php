<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Http\FormRequest;

class EditCountry extends FormRequest
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
        $input = Input::all();
        return [
            'name' => 'required|min:3|max:50|unique:countries,name,'.$input['id'],
            'iso_alpha_2' => 'required|min:2|max:2|unique:countries,iso_alpha_2,'.$input['id'],
            'iso_alpha_3' => 'required|min:3|max:3|unique:countries,iso_alpha_3,'.$input['id'],
            'currency_code' => 'required|unique:countries,currency_code,'.$input['id'],
            'dailing_code' => 'required|integer|unique:countries,dailing_code,'.$input['id'],
        ];
    }
}
