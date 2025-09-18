<?php

namespace Tests\Feature;

use App\Services\UserService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM users");
        $this->userService = $this->app->make(UserService::class);
    }

    public function testLoginSucces(): void
    {
        $this->seed(UserSeeder::class);
        self::assertTrue($this->userService->login('eza@gmail.com', 'rahasia'));
    }

    public function testLoginUserNotFound(): void
    {
        self::assertFalse($this->userService->login('userNotFound', 'rahasia'));
    }
    public function testLoginWrongPassword(): void
    {
        self::assertFalse($this->userService->login('eza@pratama', 'wrong password'));
    }
}
