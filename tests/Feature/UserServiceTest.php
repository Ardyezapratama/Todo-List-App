<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSucces(): void
    {
        self::assertTrue($this->userService->login('ezapratama', 'rahasia'));
    }

    public function testLoginUserNotFound(): void
    {
        self::assertFalse($this->userService->login('userNotFound', 'rahasia'));
    }
    public function testLoginWrongPassword(): void
    {
        self::assertFalse($this->userService->login('ezapratama', 'wrong password'));
    }
}
