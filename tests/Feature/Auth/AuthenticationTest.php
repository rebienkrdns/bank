<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('/iniciar-sesion');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();

        $response = $this->post('/iniciar-sesion', [
            'identification' => $user->identification,
            'password' => $user->identification,
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_identification()
    {
        $user = User::factory()->create();

        $this->post('/iniciar-sesion', [
            'identification' => 'wrong-identification',
            'password' => $user->identification,
        ]);

        $this->assertGuest();
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post('/iniciar-sesion', [
            'identification' => $user->identification,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_not_authenticate_without_credentials()
    {
        $this->post('/iniciar-sesion', [
            'identification' => '',
            'password' => '',
        ]);

        $this->assertGuest();
    }
}
