<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subtask;
use App\Models\Task;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubtaskController extends Controller
{
    public function createSubtask(Request $req, $taskId)
    {
        $task = Task::findOrFail($taskId);

        $subtask = $task->subtasks()->create([
            'name' => $req->name,
        ]);

        return response()->json([
            'status' => true,
            'subtask' => $subtask,
            'message' => "Subtask has been successfully created."
        ], 201);
    }

    public function getSubtaskById($id): JsonResponse
    {
        $subtask = Subtask::find($id);

        if (!$subtask) {
            return response()->json([
                'status' => false,
                'message' => "Task not found."
            ], 404);
        }

        return response()->json([
            'status' => true,
            'tasks' => $subtask
        ], 200);
    }

    public function updateSubtask(Request $req, $id): JsonResponse
    {
        DB::beginTransaction();

        $subtask = Subtask::find($id);

        if (!$subtask) {
            return response()->json([
                'status' => false,
                'message' => "Subtask not found."
            ], 404);
        }

        try {
            $subtask->update($req->only(['name', 'is_done']));

            DB::commit();

            return response()->json([
                'status' => true,
                'subtask' => $subtask,
                'message' => "Subtask has been successfully updated."
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "The subtask couldn't be updated. Error: " . $e->getMessage()
            ], 400);
        }
    }

    public function deleteSubtask($id): JsonResponse
    {
        $subtask = Subtask::find($id);

        if (!$subtask) {
            return response()->json([
                'status' => false,
                'message' => "Subtask not found."
            ], 404);
        }

        try {
            $subtask->delete();
            return response()->json([
                'status' => true,
                'message' => "The subtask has been successfully deleted."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "The subtask couldn't be deleted. Error: " . $e->getMessage()
            ], 400);
        }
    }
}
