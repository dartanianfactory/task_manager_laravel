<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true; //пока так
    }

    public function rules(): array
    {
        return [
            'project_id' => 'required|integer',
            'header' => 'required|string|max:50',
            'description' => 'sometimes|string',
            'attachment' => 'sometimes|file',
            'status' => ['required', Rule::in(['planned', 'in_progress', 'done'])],
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => 'Поле project_id обязательно для заполнения',
            'project_id.integer' => 'Поле project_id должно быть числом',
            'header.required' => 'Поле header обязательно для заполнения',
            'status.required' => 'Поле status обязательно для заполнения',
            'status.in' => 'Поле status должно содержать одно из planned, in_progress, done',
        ];
    }
}
