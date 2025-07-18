<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage(): void
    {
        $this->get('/login')
            ->assertSeeText('Login');
    }

    public function testLoginSuccess(): void
    {
        $this->post('/login', [
            'user' => 'ezapratama',
            'password' => 'rahasia',
        ])->assertRedirect('/')
            ->assertSessionHas('user', 'ezapratama');
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
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }
}
