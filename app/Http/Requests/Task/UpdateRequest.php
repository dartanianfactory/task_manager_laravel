<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true; //пока так
    }

    public function rules(): array
    {
        return [
            'header' => 'required|string|max:50',
            'description' => 'sometimes|string|max:1000',
            'status' => ['sometimes', Rule::in(['planned', 'in_progress', 'done'])],
        ];
    }

    public function messages(): array
    {
        return [
            'header.required' => 'Поле header обязательно для заполнения',
            'status.required' => 'Поле status обязательно для заполнения',
            'status.in' => 'Поле status должно содержать одно из planned, in_progress, done',
        ];
    }
}
