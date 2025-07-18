<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OnlyMemberMiddlewareTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLogoutGuest(): void
    {
        $this->post('/logout')
            ->assertRedirect('/login');
    }

    public function testLogoutMember(): void
    {
        $this->withSession([
            'user' => 'ezapratama'
        ])->post('/logout')
            ->assertRedirect('/login');
    }
}
