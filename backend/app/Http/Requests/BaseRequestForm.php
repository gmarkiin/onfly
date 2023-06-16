<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequestForm extends FormRequest
{
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            $validator->errors(), 400
        ));
    }
}
