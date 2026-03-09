<?php

namespace App\Http\Controllers;

use App\Transporter\Todos\GetCompletedTodos;

class TodoController extends Controller
{
    public function index()
    {
        $response = \App\Transporter\Todos\GetCompletedTodos::build()->send();

        $todos = json_decode($response->body(), true);

        return view('todos', compact('todos'));
    }
}
