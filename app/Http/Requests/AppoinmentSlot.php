<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppoinmentSlot extends FormRequest
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
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:' .  date("Y-m-d"),
            'start_time' => 'required|date_format:H:i|before:end_time',
            'end_time' => 'required|date_format:H:i',
            'interval' => 'required|integer|min:2|max:120',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start_time.before' => 'Start time must before end time',
            'interval.min' => 'Intverval must be greater than 2 min.',
            'interval.max' => 'Intverval must be less than 120 min.',
        ];
    }
}
