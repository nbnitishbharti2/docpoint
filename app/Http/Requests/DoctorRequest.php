<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class DoctorRequest extends FormRequest
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
        $doctor_id = ($this->route('id') != 0) ? $this->route('id') : 0;
        $input = Input::all();
        $user_id = isset($input['user_id']) ? $input['user_id'] : 0;
        return [
            'name' => 'required|min:4|max:40',
            'email' => 'required|email|unique:users,email,'.$user_id.'|unique:doctors,email,'.$doctor_id,
            // 'speciality' => 'required',
            'speciality_id' => 'required',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10|unique:users,mobile,'.$user_id,
            'gender' => 'required',
            'pic' => 'mimes:jpeg,jpg,png,gif|max:2048',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required|min:5|max:200',
            'zip' => 'numeric',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10|unique:doctors,phone,'.$doctor_id,
            'alt_moblie' => 'nullable|numeric',
            'fax' => 'nullable|numeric',
            'website' => 'nullable|url',
            'dob' => 'required|date',
            'password' => 'nullable|confirmed|min:6',
        ];

    }

    public function messages()
    {
        return [            
            'pic.max' => "Maximum file size to upload is 2MB."
        ];
    }
}
