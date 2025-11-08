<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ListRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true; //пока так
    }

    public function rules(): array
    {
        return [
            'project_id' => 'integer',
            'user_id' => 'integer',
            'status' => [Rule::in(['planned', 'in_progress', 'done'])],
            'finish_at' => [Rule::date()->format('Y-m-d'),],
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.integer' => 'user_id должно быть числом',
            'user_id.integer' => 'user_id должно быть числом',
            'finish_at.date' => 'Введите дату в формате YYYY-MM-DD',
            'status.in' => 'Поле status должно содержать одно из planned, in_progress, done',
        ];
    }
}
