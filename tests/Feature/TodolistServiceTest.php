<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    public function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull(): void
    {
        self::assertNotNull($this->todolistService);
    }

    public function testSaveTodo(): void
    {
        $this->todolistService->saveTodo('1', 'Make Food');
        $todolist = Session::get('todolist');
        foreach ($todolist as $value) {
            self::assertEquals('1', $value['id']);
            self::assertEquals('Make Food', $value['todo']);
        }
    }

    public function testGetTodolistEmpty(): void
    {
        self::assertEquals([], $this->todolistService->getTodo());

    }

    public function testGetTodolistNotEmpty(): void
    {
        $expected = [
            [
                'id' => '1',
                'todo' => 'Make Food'
            ],
            [
                'id' => '2',
                'todo' => 'Learning Laravel'
            ]
        ];

        $this->todolistService->saveTodo('1', 'Make Food');
        $this->todolistService->saveTodo('2', 'Learning Laravel');

        self::assertEquals($expected, $this->todolistService->getTodo());
    }

    public function testDeleteTodo(): void
    {
        $this->todolistService->saveTodo('1', 'Make Food');
        $this->todolistService->saveTodo('2', 'Learning Laravel');

        self::assertEquals(2, sizeof($this->todolistService->getTodo()));

        $this->todolistService->deleteTodo('3');
        self::assertEquals(2, sizeof($this->todolistService->getTodo()));

        $this->todolistService->deleteTodo('1');
        self::assertEquals(1, sizeof($this->todolistService->getTodo()));

        $this->todolistService->deleteTodo('2');
        self::assertEquals(0, sizeof($this->todolistService->getTodo()));
    }
}
