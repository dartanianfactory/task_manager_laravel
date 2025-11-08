<?php

namespace App\Http\Controllers\Api\Task;

use App\Exceptions\Task\TaskNotFoundException;
use App\Http\Requests\Task\ListRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Http\Resources\Task\TaskResource;
use App\Http\Resources\Task\TaskCollection;
use App\Models\Project\Task;
use App\Services\Task\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTaskController extends Controller
{
    public function list(ListRequest $request, TaskService $taskService): JsonResponse
    {
        try {
            $request->validated();

            $filteredTasks = new TaskCollection(
                $taskService->getFilteredTasks(
                    $request->project_id ?? null,
                    $request->user_id ?? null,
                    $request->status ?? null,
                    $request->finish_at ?? null,
                )
            );

            $filteredTasks = $filteredTasks->toArray($request);

            if (empty($filteredTasks['items'])) {
                throw new TaskNotFoundException('Задач по данному запросу не найдено');
            }

            return $this->success($filteredTasks, 'Задачи найдены!');
        } catch (TaskNotFoundException $err) {
            return $this->conflict($err, $err->getMessage());
        } catch (\Throwable $err) {
            return $this->conflict($err, $err->getMessage());
        }
    }

    public function view(Request $request, int $id): JsonResponse
    {
        try {
            $task = Task::find($id);

            if ($task) {
                $task = new TaskResource($task);
                $task = $task->toArray($request);

                return $this->success($task, 'Задача найдена!');
            }

            throw new TaskNotFoundException();
        } catch (TaskNotFoundException $err) {
            return $this->conflict($err, $err->getMessage());
        } catch (\Throwable $err) {
            return $this->conflict($err, $err->getMessage());
        }
    }

    public function store(StoreRequest $request, TaskService $taskService): JsonResponse
    {
        try {
            $validateData = $request->validated();

            $task = $taskService->store($validateData);

            return $this->success($task, 'Задача создана!');
        } catch (TaskNotFoundException $err) {
            return $this->conflict($err, $err->getMessage());
        } catch (\Throwable $err) {
            return $this->conflict($err, $err->getMessage());
        }
    }

    public function update(UpdateRequest $request, TaskService $taskService, int $id): JsonResponse
    {
        try {
            $user = Auth::user();

            $validateData = $request->validated();
            $validateData['id'] = $id;
            $validateData['user_id'] = $user->id;

            $result = $taskService->update($validateData);

            return $this->success($result, 'Задача обновлена!');
        } catch (TaskNotFoundException $err) {
            return $this->conflict($err, $err->getMessage());
        } catch (\Throwable $err) {
            return $this->conflict($err, $err->getMessage());
        }
    }

    public function delete(Request $request, TaskService $taskService, int $id): JsonResponse
    {
        try {
            $result = $taskService->delete(['id' => $id]);

            return $this->success($result, 'Задача удалена!');
        } catch (TaskNotFoundException $err) {
            return $this->conflict($err, $err->getMessage());
        } catch (\Throwable $err) {
            return $this->conflict($err, $err->getMessage());
        }
    }
}