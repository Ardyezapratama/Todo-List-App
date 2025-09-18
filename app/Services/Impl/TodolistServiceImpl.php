<?php

namespace App\Services\Impl;

use App\Models\Todo;
use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceImpl implements TodolistService
{

    public function saveTodo(string $id, string $todo): void
    {
        $todo = new Todo([
            "id" => $id,
            "todo" => $todo
        ]);
        $todo->save();
    }

    public function getTodo(): array
    {
        return Todo::query()->get()->toArray();
    }

    public function deleteTodo(string $todoId): void
    {
        $todo = Todo::query()->find($todoId);
        if ($todo != null) {
            $todo->delete();
        }
    }
}
