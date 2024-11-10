<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use App\Models\Subtask;
use Tests\TestCase;

class SubtaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_subtask()
    {
        $task = Task::factory()->create();

        $response = $this->postJson("/api/subtasks/{$task->id}", [
            'name' => 'Test Subtask',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'status' => true,
                'message' => "Subtask has been successfully created.",
            ]);

        $this->assertDatabaseHas('subtasks', [
            'name' => 'Test Subtask',
            'task_id' => $task->id,
        ]);
    }

    /** @test */
    public function it_can_fetch_a_subtask_by_id()
    {
        $task = Task::factory()->create();
        $subtask = Subtask::factory()->create(['task_id' => $task->id]);

        $response = $this->getJson("/api/subtasks/{$subtask->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'tasks' => [
                    'id' => $subtask->id,
                    'name' => $subtask->name,
                ],
            ]);
    }

    /** @test */
    public function it_returns_not_found_for_non_existent_subtask()
    {
        $response = $this->getJson('/api/subtasks/999');

        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => "Task not found.",
            ]);
    }

    /** @test */
    public function it_can_update_a_subtask()
    {
        $task = Task::factory()->create();
        $subtask = Subtask::factory()->create(['task_id' => $task->id]);

        $response = $this->putJson("/api/subtasks/{$subtask->id}", [
            'name' => 'Updated Subtask',
            'is_done' => true,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => "Subtask has been successfully updated.",
            ]);

        $this->assertDatabaseHas('subtasks', [
            'id' => $subtask->id,
            'name' => 'Updated Subtask',
            'is_done' => true,
        ]);
    }

    /** @test */
    public function it_returns_not_found_for_update_non_existent_subtask()
    {
        $response = $this->putJson('/api/subtasks/999', [
            'name' => 'Non-existent Subtask',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => "Subtask not found.",
            ]);
    }

    /** @test */
    public function it_can_delete_a_subtask()
    {
        $task = Task::factory()->create();
        $subtask = Subtask::factory()->create(['task_id' => $task->id]);

        $response = $this->deleteJson("/api/subtasks/{$subtask->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => "The subtask has been successfully deleted.",
            ]);

        $this->assertDatabaseMissing('subtasks', ['id' => $subtask->id]);
    }

    /** @test */
    public function it_returns_not_found_for_delete_non_existent_subtask()
    {
        $response = $this->deleteJson('/api/subtasks/999');

        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => "Subtask not found.",
            ]);
    }
}
