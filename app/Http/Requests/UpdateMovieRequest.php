<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

use App\Http\Helpers\ValidationHelpers;

class UpdateMovieRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'string',
                'unique:App\Models\Movie,name'
            ]
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