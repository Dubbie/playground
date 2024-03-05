<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileControllerTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_index_redirects_unauthenticated()
    {
        $response = $this->get(route('file.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_index_loads_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('file.index'));

        $response->assertStatus(200);
    }

    public function test_download()
    {
        $user = User::factory()->create();

        $file = $user->storedFiles()->create([
            'name' => 'test.txt',
            'path' => 'test.txt',
            'type' => 'text/plain',
            'size' => 1024,
        ]);

        // Put a mock file in the storage directory
        Storage::put('test.txt', 'test');

        $response = $this->actingAs($user)->get(route('file.download', ['file' => $file->id]));

        $response->assertDownload('test.txt');
    }
}
