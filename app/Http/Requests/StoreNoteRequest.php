<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreNoteRequest extends FormRequest
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
            'title' => 'required|min:5|max:150',
            'content' => 'required|max:255',
            'user_id' => 'required|not_in:0',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['errors' => 'Unprocessable Entity, validation failed','message'=>$validator->errors()], 422));
    }

}
