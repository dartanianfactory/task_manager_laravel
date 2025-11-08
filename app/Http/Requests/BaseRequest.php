<?php

namespace App\Http\Requests;

use App\Traits\ApiResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Log;

class BaseRequest extends FormRequest
{
    use ApiResponseTrait;
    
    public function failedValidation(Validator $validator)
    {
        Log::info('Validation errors in BaseRequest:', $validator->errors()->toArray());

        throw new HttpResponseException($this->notValid($validator->errors()->toArray(), 'Validation failed!'));
    }
}
