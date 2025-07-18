<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todolist(Request $request): Response
    {
        $todolist = $this->todolistService->getTodo();
        return response()->view('todolist.todolist', [
            'title' => 'Todolist',
            'todolist' => $todolist
        ]);
    }

    public function addTodo(Request $request): Response|RedirectResponse
    {
        $todo = $request->input('todo');
        if (empty($todo)) {
            $todolist = $this->todolistService->getTodo();
            return response()->view('todolist.todolist', [
                'title' => 'Todolist',
                'todolist' => $todolist,
                'error' => 'Todo is required!'
            ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class, 'todolist']);
    }

    public function deleteTodo(Request $request, string $todoId): Response|RedirectResponse
    {
        $this->todolistService->deleteTodo($todoId);
        return redirect()->action([TodolistController::class, 'todolist']);
    }
}
