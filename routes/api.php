<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PingController;
use App\Http\Controllers\Api\SubtaskController;
use App\Http\Controllers\Api\TasksController;

// ping API
Route::get('/ping', [PingController::class, 'ping']); // GET -> APP_URL/api/ping

// Task CRUD
Route::get('/tasks', [TasksController::class, 'getTasks']); // GET -> APP_URL/api/tasks?page={{number}}
Route::get('/tasks/{taskId}', [TasksController::class, 'getTaskById']); // GET -> APP_URL/api/tasks/{{taskId}}
Route::post('/tasks', [TasksController::class, 'createTask']); // POST -> APP_URL/api/tasks
Route::put('/tasks/{taskId}', [TasksController::class, 'updateTask']); // PUT -> APP_URL/api/tasks/{{taskId}}
Route::delete('/tasks/{taskId}', [TasksController::class, 'deleteTask']); // DELETE -> APP_URL/api/tasks/{{taskId}}

// Subtask CRUD
Route::get('/subtasks/{taskId}', [SubtaskController::class, 'getSubtaskById']); // GET -> APP_URL/api/subtasks/{{subtaskId}}
Route::post('/subtasks/{taskId}', [SubtaskController::class, 'createSubtask']); // POST -> APP_URL/api/subtasks/{{taskId}}
Route::put('/subtasks/{subtaskId}', [SubtaskController::class, 'updateSubtask']); // PUT -> APP_URL/api/subtasks/{{subtaskId}}
Route::delete('/subtasks/{subtaskId}', [SubtaskController::class, 'deleteSubtask']); // DELETE -> APP_URL/api/tasks/{{subtaskId}}
