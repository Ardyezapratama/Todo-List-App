<?php

namespace App\Services\Impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{

    public function saveTodo(string $id, string $todo): void
    {
        if (!Session::exists('todolist')) {
            Session::put('todolist', []);
        }

        Session::push('todolist', [
            'id' => $id,
            'todo' => $todo
        ]);
    }

    public function getTodo(): array
    {
        return Session::get('todolist', []);
    }

    public function deleteTodo(string $todoId): void
    {
        $todolist = Session::get('todolist');
        foreach ($todolist as $index => $value) {
            if ($value['id'] === $todoId) {
                unset($todolist[$index]);
                break;
            }
        }

        Session::put('todolist', $todolist);
    }
}
