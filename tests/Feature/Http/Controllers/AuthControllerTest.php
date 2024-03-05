<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_login_loads_unauthenticated()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_login_redirects_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/dashboard');
    }

    public function test_register_loads_unauthenticated()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_register_loads_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/register');

        $response->assertRedirect('/dashboard');
    }

    public function test_register_works()
    {
        $response = $this->postJson('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);
    }

    public function test_login_works()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }

    public function test_login_fail_works()
    {
        $response = $this->postJson('/login', [
            'email' => 'testest@gmail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(400);
    }

    public function test_logout_works()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
    }
}
