<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function getTasks(): JsonResponse
    {
        // Get all tasks on database order by id and descending and his substasks
        $tasks = Task::with('subtasks')->orderBy('id', 'DESC')->paginate(8);

        // Return the response of the tasks on the database
        return response()->json([
            'status' => true,
            'tasks' => $tasks,
        ], 200);
    }

    public function getTaskById($id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => "Task not found."
            ], 404);
        }

        return response()->json([
            'status' => true,
            'tasks' => $task->load('subtasks')
        ], 200);
    }

    public function createTask(Request $req)
    {
        DB::beginTransaction();

        try {
            $task = Task::create([
                'name' => $req->name,
                'description' => $req->description,
            ]);
            DB::commit();

            return response()->json([
                'status' => true,
                'task' => $task->load('subtasks'),
                'message' => "Task has been successfully created."
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "The task couldn't be created."
            ], 400);
        }
    }

    public function updateTask(Request $req, $id): JsonResponse
    {
        DB::beginTransaction();

        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => "Task not found."
            ], 404);
        }

        try {
            $task->update($req->only(['name', 'description', 'is_done']));
            DB::commit();

            return response()->json([
                'status' => true,
                'task' => $task,
                'message' => "Task has been successfully updated."
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "The task couldn't be updated."
            ], 400);
        }
    }

    public function deleteTask($id): JsonResponse
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'status' => false,
                'message' => "Task not found."
            ], 404);
        }

        try {
            $task->delete();
            return response()->json([
                'status' => true,
                'message' => "The task has been successfully deleted."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "The task couldn't be deleted. Error: " . $e->getMessage()
            ], 400);
        }
    }
}
