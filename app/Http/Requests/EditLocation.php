<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditLocation extends FormRequest
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
            'name' => 'required|min:2|max:50', 
            'pincode' => 'required|digits:6',
        ];
    }
    public function messages()
    {
        return [            
            'pincode.required' => "The Pin Code Required fields.",
            'pincode.digits' => "The Pin Code must be 6 digits.", 

        ];
    }
}
