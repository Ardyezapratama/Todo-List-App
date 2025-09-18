<?php

namespace Tests\Feature;

use Database\Seeders\TodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("DELETE FROM todos");
    }
    public function testTodolist()
    {
        $this->seed(TodoSeeder::class);

        $this->withSession([
            'user' => 'eza@gmail.com',
        ])->get('/todolist')
            ->assertSeeText('1')
            ->assertSeeText('Make Food')
            ->assertSeeText('2')
            ->assertSeeText('Learning Laravel');
    }

    public function testAddTodoFailed(): void
    {
        $this->withSession([
            'user' => 'ezapratama',
        ])->post('/todolist', [])
            ->assertSeeText('Todo is required!');

    }

    public function testAddTodoSuccess(): void
    {
        $this->withSession([
            'user' => 'ezapratama'
        ])->post('/todolist', [
                    'todo' => 'Make Food',
                ])->assertRedirect('/todolist');

    }

    public function testDeleteTodoList(): void
    {
        $this->withSession([
            'user' => 'ezapratama',
            'todolist' => [
                [
                    'id' => '1',
                    'todo' => 'Make Food',
                ],
                [
                    'id' => '2',
                    'todo' => 'Learning Laravel'
                ]
            ]
        ])->post('/todolist/1/delete')
            ->assertRedirect('/todolist');
    }
}
