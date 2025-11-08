<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Task\ApiTaskController;
use App\Http\Controllers\Api\User\ApiAuthController;


Route::middleware('guest')->group(function () {
    Route::controller(ApiAuthController::class)->group(function () {
        Route::post('/user/login', 'login')->name('user.actions.login');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ApiAuthController::class)->group(function () {
        Route::post('/user/logout', 'logout')->name('user.actions.logout');
    });

    Route::controller(ApiTaskController::class)->group(function () {
        Route::get('/projects/{project_id}/tasks', 'list')->name('task.data.list');
        Route::post('/projects/{project_id}/tasks', 'store')->name('task.actions.store');
        Route::get('/tasks/{id}', 'view')->name('task.data.view');
        Route::put('/tasks/{id}', 'update')->name('task.actions.update');
        Route::delete('/tasks/{id}', 'delete')->name('task.actions.delete');

        /*  Описание из ТЗ
        
            GET /api/projects/{project_id}/tasks — получение списка задач по проекту с фильтрацией по статусу, исполнителю и дате завершения;
            POST /api/projects/{project_id}/tasks — создание новой задачи;
            GET /api/tasks/{id} — получение информации о задаче;
            PUT /api/tasks/{id} — обновление данных задачи;
            DELETE /api/tasks/{id} — удаление задачи.
        */
    });
});
