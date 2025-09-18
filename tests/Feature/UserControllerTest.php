<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM users");
    }
    public function testLoginPage(): void
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginSuccess(): void
    {
        $this->seed(UserSeeder::class);
        $this->post('/login', [
            'user' => 'eza@gmail.com',
            'password' => 'rahasia',
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'eza@gmail.com');
    }

    public function testLoginValidationError(): void
    {
        $this->post('/login', [])
            ->assertSeeText('User and password is required!');
    }

    public function testLoginFailed(): void
    {
        $this->post('/login', [
            'user' => 'wrong',
            'password' => 'wrong'
        ])->assertSeeText('User or password is wrong');
    }

    public function testLogOut(): void
    {
        $this->withSession([
            'user' => 'ezapratama',
        ])->post('/logout')
            ->assertRedirect('/login')
            ->assertSessionMissing('user');
    }
}
