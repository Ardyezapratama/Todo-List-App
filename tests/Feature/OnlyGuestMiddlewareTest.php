<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OnlyGuestMiddlewareTest extends TestCase
{
    public function testLoginPageForMember(): void
    {
        $this->withSession([
            'user' => 'ezapratama'
        ])->get('/login')
            ->assertRedirect('/');
    }

    public function testLoginForUserAlreadyLoggedIn(): void
    {
        $this->withSession([
            'user' => 'ezapratama',
        ])->get('/login')->assertRedirect('/');
    }
}
