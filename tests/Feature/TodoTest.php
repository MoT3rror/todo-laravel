<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can create a todo.
     */
    public function test_user_can_create_todo(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Act as the user and send a POST request to create a todo
        $response = $this->actingAs($user)->post(route('todos.store'), [
            'title' => 'Test Todo',
        ]);

        // Assert the todo was created and the user is redirected to the dashboard
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('todos', [
            'title' => 'Test Todo',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test that a todo cannot be created without a title.
     */
    public function test_todo_creation_requires_title(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Act as the user and send a POST request without a title
        $response = $this->actingAs($user)->post(route('todos.store'), [
            'title' => '',
        ]);

        // Assert validation error
        $response->assertSessionHasErrors(['title']);
        $this->assertDatabaseMissing('todos', [
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test that only authenticated users can create todos.
     */
    public function test_only_authenticated_users_can_create_todos(): void
    {
        // Send a POST request without authentication
        $response = $this->post(route('todos.store'), [
            'title' => 'Test Todo',
        ]);

        // Assert the user is redirected to the login page
        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('todos', [
            'title' => 'Test Todo',
        ]);
    }
}