<?php

namespace App\Services\Task;

use App\Exceptions\Task\TaskNotFoundException;
use App\Models\Common\GlobalSettings;
use App\Models\Project\Task;
use App\Notifications\Task\StoreNotification;
use App\Notifications\Task\UpdateNotification;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function store($data)
    {
        $user = Auth::user();
        $data['user_id'] = $user->id;
        
        $task = Task::create($data);

        if (request()->hasFile('attachment') && request()->file('attachment')->isValid()) {
            $task->addMediaFromRequest('attachment')->toMediaCollection('attachments');
        }

        $user->notify(new StoreNotification($task));

        return $task;
    }

    public function update($data): ?Task
    {
        $id = $data['id'];
        $user = Auth::user();
        $user_id = $user->id;

        $query = Task::query()->where('id', $id)->where('user_id', $user_id);

        $exists = $query->exists();
        if ($exists) {
            $task = $query->first();
            $task->update($data);

            $user->notify(new UpdateNotification($task));

            return $task;
        }

        throw new TaskNotFoundException();
    }

    public function delete($data): bool
    {
        $id = $data['id'];
        $user = Auth::user();
        $query = Task::query()->where('id', $id)->where('user_id', $user->id);

        if ($query->exists()) {
            $query->delete();

            return true;
        }

        throw new TaskNotFoundException();
    }

    public function getFilteredTasks(?int $project_id, ?int $user_id, ?string $status, ?Timestamp $finish_at)
    {
        $tasks = Task::query();

        if ($project_id) {
            $tasks->where('project_id', $project_id);
        }

        if ($user_id) {
            $tasks->where('user_id', $user_id);
        }

        if ($status) {
            $tasks->where('status', $status);
        }

        if ($finish_at) {
            $tasks->where('finish_at', $finish_at);
        }

        $tasks = $tasks->paginate(GlobalSettings::DEFAULT_PER_PAGES);

        return $tasks;
    }
}