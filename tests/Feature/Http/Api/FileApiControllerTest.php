<?php

namespace Tests\Feature\Http\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileApiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_get_works()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('api.file.get'));

        $response->assertStatus(200);
    }

    public function test_create_works()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('api.file.create'), [
            'files' => [
                UploadedFile::fake()->create('test.txt', 1024, 'text/plain'),
            ],
        ]);

        $response->assertStatus(200);
    }

    public function test_destroy_works()
    {
        $user = User::factory()->create();
        $file = $user->storedFiles()->create([
            'name' => 'test.txt',
            'path' => 'test.txt',
            'type' => 'text/plain',
            'size' => 1024,
        ]);

        $response = $this->actingAs($user)->delete(route('api.file.destroy', ['file' => $file->id]));

        $response->assertStatus(200);
    }
}
