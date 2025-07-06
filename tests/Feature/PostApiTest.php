<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_posts()
    {
        Post::factory()->count(3)->create();

        $response = $this->get('/api/posts');
        $response->assertStatus(200);
    }

    public function test_can_create_post()
    {
        $data = [
            'title' => 'Judul test',
            'content' => 'Konten test',
            'author' => 'Penulis test',
        ];

        $response = $this->postJson('/api/posts', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', $data);
    }
}
