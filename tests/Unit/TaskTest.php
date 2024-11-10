<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_can_fetch_all_tasks()
    {
        Task::factory()->count(5)->create();

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'tasks' => [
                    'data' => [
                        '*' => [
                            'id',
                            'name',
                            'description',
                            'is_done',
                            'subtasks'
                        ]
                    ]
                ]
            ]);
    }

    /** @test */
    public function it_can_fetch_a_task_by_id()
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'status' => true,
                'tasks' => [
                    'id' => $task->id,
                    'name' => $task->name,
                    'description' => $task->description,
                ]
            ]);
    }

    /** @test */
    public function it_returns_not_found_for_non_existent_task()
    {
        $response = $this->getJson('/api/tasks/999');

        $response->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'status' => false,
                'message' => 'Task not found.'
            ]);
    }

    /** @test */
    public function it_can_create_a_task()
    {
        $taskData = [
            'name' => 'Test Task',
            'description' => 'This is a test task.',
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'status' => true,
                'message' => 'Task has been successfully created.',
            ]);

        $this->assertDatabaseHas('tasks', $taskData);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create();

        $updatedData = [
            'name' => 'Updated Task Name',
            'description' => 'Updated description.',
            'is_done' => true,
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $updatedData);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'status' => true,
                'message' => 'Task has been successfully updated.',
            ]);

        $this->assertDatabaseHas('tasks', $updatedData);
    }

    /** @test */
    public function it_returns_not_found_for_update_non_existent_task()
    {
        $response = $this->putJson('/api/tasks/999', [
            'name' => 'Non-existent Task',
            'description' => 'Trying to update a non-existent task.',
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'status' => false,
                'message' => 'Task not found.'
            ]);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'status' => true,
                'message' => 'The task has been successfully deleted.'
            ]);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    /** @test */
    public function it_returns_not_found_for_delete_non_existent_task()
    {
        $response = $this->deleteJson('/api/tasks/999');

        $response->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJson([
                'status' => false,
                'message' => 'Task not found.'
            ]);
    }
}
