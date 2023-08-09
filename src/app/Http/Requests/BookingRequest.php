<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'date' => ['required','after:today'],
            'time' => ['required'],
            'number' => ['required', 'digits_between:1,100'],
        ];
    }

    public function messages()
    {
        return [
            'date.after' => '今日より後の日付を指定してください。',
            'number.digits_between' => '人数は１人以上を指定してください。'
        ];
    }
}
