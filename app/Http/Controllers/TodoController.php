<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transporter\Todos\GetTodos;

class TodoController extends Controller
{
   public function index(Request $request)
{
    $response = GetTodos::build()->send();

    $todos = json_decode($response->body(), true);

    // ✅ FILTER LOCALLY (IMPORTANT FIX)
    if ($request->search) {
        $todos = array_filter($todos, function ($todo) use ($request) {
            return stripos($todo['title'], $request->search) !== false;
        });
    }

    if ($request->completed !== null && $request->completed !== '') {
        $todos = array_filter($todos, function ($todo) use ($request) {
            return (int)$todo['completed'] === (int)$request->completed;
        });
    }

    return view('todos', [
        'todos' => $todos,
        'search' => $request->search,
        'completed' => $request->completed,
        'page' => $request->page ?? 1,
        'pages' => 5
    ]);
}
}