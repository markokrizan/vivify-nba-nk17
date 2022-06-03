<?php

namespace Tests\Feature;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

// Naziv klase mora zavrsavati sa Test
class AuthTest extends TestCase
{
    // Imena metoda moraju pocinjati sa test
    // U koliko ovo nije ispunjeno test se nece racunati

    public function testLoginForm()
    {
        $response = $this->get('/login');

        $response->assertViewIs('auth.login');
        $response->assertStatus(200);
    }

    public function testLoginFormValidation()
    {
        $response = $this
            ->post('/login');

        $response->assertSessionHasErrors([
            'email',
            'password',
        ]);

        $response->assertStatus(302);
    }

    public function testRegisterForm()
    {
        $response = $this->get('/register');

        $response->assertViewIs('auth.register');
        $response->assertStatus(200);
    }

    public function testRegisterFormValidation()
    {
        $response = $this
            ->post('/register');

        $response->assertSessionHasErrors([
            'name',
            'email',
            'password',
            'password_confirmation'
        ]);

        $response->assertStatus(302);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccesfullRegister()
    {
        Event::fake([Registered::class]);

        $response = $this
            ->post('/register', [
                'name' => 'Test User',
                'email' => 'testuser@mail.com',
                'password' => 'test123',
                'password_confirmation' => 'test123'
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas(
            'users',
            [
                'email' => 'testuser@mail.com'
            ]
        );

        Event::assertDispatched(Registered::class);
    }
}
