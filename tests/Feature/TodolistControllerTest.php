<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
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
