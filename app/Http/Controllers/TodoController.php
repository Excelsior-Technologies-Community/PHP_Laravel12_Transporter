<?php

namespace App\Http\Controllers;

use App\Transporter\Todos\GetTodos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class TodoController extends Controller
{
    public function index(Request $request)
    {
        $response = GetTodos::build()->send();
        $apiTodos = json_decode($response->body(), true);
        
        $localTodos = Session::get('local_todos', []);
        $todos = array_merge($localTodos, $apiTodos);

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
            'completed' => $request->completed
        ]);
    }

    public function store(Request $request)
    {
        $newTodo = [
            'id' => rand(1000, 9999),
            'title' => $request->title,
            'completed' => false
        ];

        $todos = Session::get('local_todos', []);
        array_unshift($todos, $newTodo);
        Session::put('local_todos', $todos);

        return redirect()->back()->with('success', 'Todo created!');
    }

    public function update($id)
    {
        $todos = Session::get('local_todos', []);
        foreach ($todos as &$todo) {
            if ($todo['id'] == $id) {
                $todo['completed'] = true;
            }
        }
        Session::put('local_todos', $todos);
        
        return redirect()->back()->with('success', 'Todo updated!');
    }

    public function healthCheck()
    {
        $start = microtime(true);
        $response = Http::get('https://jsonplaceholder.typicode.com/todos/1');
        $latency = (microtime(true) - $start) * 1000;
        
        return view('health', [
            'status' => $response->successful() ? 'Online' : 'Offline',
            'latency' => round($latency, 2)
        ]);
    }
}