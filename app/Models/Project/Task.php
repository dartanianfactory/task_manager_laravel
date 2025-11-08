<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'header',
        'description',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'project_id' => 'integer',
            'header' => 'string',
            'description' => 'string',
            'status' => 'string',
        ];
    }
}
