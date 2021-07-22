<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Helpers\ValidationHelpers;
use Illuminate\Support\Arr;

class CreateBookingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => [
                'required',
                'integer',
                'exists:App\Models\Customer,id'
            ],
            'showing_id' => [
                'required',
                'integer',
                'exists:App\Models\Showing,id'
            ],
            'seats' => [
                'required',
                'integer',
                'gt:0'
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