<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

use App\Http\Helpers\ValidationHelpers;

class CreateShowingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'screen_id' => [
                'required',
                'integer',
                'exists:App\Models\Screen,id'
            ],
            'movie_id' => [
                'required',
                'integer',
                'exists:App\Models\Movie,id'
            ],
            'time' => [
                'required',
                'string',
                'regex:/^([01][0-9]|2[0-3]):([0-5][0-9])/',
            ],
        ];
    }

    /**
     * Custom response handler when fails validation
     *
     * @param Illuminate\Contracts\Validation\Validator $validator
     * 
     * @return ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException(
            $validator,
            ValidationHelpers::getResponse($validator->errors()->toArray())
        );
    }
}