<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\User;
use App\Http\Controllers\UserController;

class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function testGetUserPosts()
    {
        // Create a user
        $user = User::factory()->create();

        // Create posts for the user
        Post::factory()->count(3)->create(['user_id' => $user->id]);

        // Call the getUserPosts method
        $response = $this->get("/users/{$user->id}/posts");

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the response contains the user's posts
        $this->assertCount(3, $response->viewData('posts'));
    }

    public function testGetUserComments()
    {
        // Create a user
        $user = User::factory()->create();

        // Create comments for the user
        Comment::factory()->count(5)->create(['user_id' => $user->id]);

        // Call the getUserComments method
        $response = $this->get("/users/{$user->id}/comments");

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the response contains the user's comments
        $this->assertCount(5, $response->viewData('comments'));
    }

    // Add your test methods here
}
