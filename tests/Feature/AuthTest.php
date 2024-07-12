<?php

namespace Tests\Feature;

use App\Models\Officer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_user_can_view_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'supervisor'
        ]);

        $response = $this->withSession(['_token' => csrf_token()])->post('/login', [
            '_token' => csrf_token(),
            'login' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_officer_can_login_with_correct_credentials()
    {
        $officer = Officer::factory()->create([
            'nip' => '12345',
            'password' => bcrypt('password')
        ]);

        $response = $this->withSession(['_token' => csrf_token()])->post('/login', [
            '_token' => csrf_token(),
            'login' => '12345',
            'password' => 'password'
        ]);

        $response->assertRedirect('/officer/dashboard');
        $this->assertAuthenticatedAs($officer, 'officer');
    }

    public function test_officer_cannot_login_with_incorrect_nip()
    {
        Officer::factory()->create([
            'nip' => '12345',
            'password' => bcrypt('password')
        ]);

        $response = $this->withSession(['_token' => csrf_token()])->post('/login', [
            '_token' => csrf_token(),
            'login' => '54321',
            'password' => 'password'
        ]);

        $response->assertSessionHasErrors('login');
        $this->assertGuest('officer');
    }

    public function test_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->withSession(['_token' => csrf_token()])->post('/logout', [
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect('/');
        $this->assertGuest();
    }

    public function test_officer_can_logout()
    {
        $officer = Officer::factory()->create();
        $this->actingAs($officer, 'officer');

        $response = $this->withSession(['_token' => csrf_token()])->post('/logout', [
            '_token' => csrf_token(),
        ]);

        $response->assertRedirect('/');
        $this->assertGuest('officer');
    }
}
