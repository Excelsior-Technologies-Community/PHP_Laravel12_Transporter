# PHP_Laravel12_Transporter

## Introduction

PHP_Laravel12_Transporter is a demonstration project built with Laravel 12 that showcases a modern, object-oriented approach to handling API requests using the Laravel Transporter package.

Instead of scattering HTTP requests across controllers and services, Laravel Transporter allows developers to:

- Encapsulate API logic into dedicated request classes

- Keep controllers clean and maintainable

- Easily reuse and test API requests

- Centralize API configurations

This project fetches completed TODO tasks from the JSONPlaceholder API
 as a practical example. It demonstrates how to structure API requests in Laravel using Transporter, making your application architecture scalable, maintainable, and professional.

---

## Project Overview

The main goal of this project is to provide a clean, reusable, and modern way to manage external API calls in Laravel applications.

Key features demonstrated in this project:

- OOP API Requests: Each API endpoint is handled by a dedicated class.

- Centralized Configuration: The base API URL is managed in a config file (config/transporter.php) and .env.

- Controller Simplification: Controllers simply call the request classes to fetch data, keeping them minimal.

- Dynamic Blade Rendering: The fetched API data is displayed in a clean, responsive Tailwind CSS interface.

- Reusable Architecture: Adding new API endpoints is as simple as creating a new Transporter class.


---


# Project Setup

## Step 1 — Create Laravel 12 Project

Create a new Laravel project.

```bash
composer create-project laravel/laravel PHP_Laravel12_Transporter "12.*"
```

Move into the project directory:

```bash
cd PHP_Laravel12_Transporter
```

Run the development server:

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000
```

---

## Step 2 — Install Laravel Transporter

Install the transporter package.

```bash
composer require juststeveking/laravel-transporter
```

---

## Step 3 — Publish Transporter Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --provider="JustSteveKing\Transporter\TransporterServiceProvider" --tag="transporter-config"
```

This creates a config file:

```bash
config/transporter.php
```

```php
<?php

declare(strict_types=1);

return [
    'base_uri' => env('TRANSPORTER_BASE_URI'),
];
```

After Open your .env file and add this line:

```bash
TRANSPORTER_BASE_URI=https://jsonplaceholder.typicode.com
```

---

## Step 4 — Create Transporter Folder Structure

Inside the **app** directory create a new folder:

```
app
 └── Transporter
```

Inside this folder we will store all API request classes.

Example structure:

```
app
 └── Transporter
      ├── JsonPlaceholderRequest.php
      └── Todos
            └── GetCompletedTodos.php
```

---

## Step 5 — Create Base Request Class

Create a base transporter request class.

Location:

```
app/Transporter/JsonPlaceholderRequest.php
```

### JsonPlaceholderRequest.php

```php
<?php

namespace App\Transporter;

use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\Transporter\Request;

abstract class JsonPlaceholderRequest extends Request
{
    protected string $baseUrl = 'https://jsonplaceholder.typicode.com';
    public function withRequest(PendingRequest $request): void
    {
        $request->acceptJson();
    }
}
```

### Explanation

This base class defines:

| Property    | Purpose                    |
| ----------- | -------------------------- |
| baseUrl     | Base API URL               |
| withRequest | Configure request settings |

All API requests will extend this class.

---

## Step 6 — Create API Request Class

Create a folder:

```
app/Transporter/Todos
```

Create file:

```
GetCompletedTodos.php
```

### GetCompletedTodos.php

```php
<?php

namespace App\Transporter\Todos;

use App\Transporter\JsonPlaceholderRequest;

class GetCompletedTodos extends JsonPlaceholderRequest
{
    protected string $method = 'GET';

    protected string $path = '/todos?completed=true';
}
```

### Explanation

| Property | Purpose             |
| -------- | ------------------- |
| method   | HTTP request method |
| path     | API endpoint        |


---

## Step 7 — Create Controller

Create controller.

```bash
php artisan make:controller TodoController
```

Location:

```
app/Http/Controllers/TodoController.php
```

### TodoController.php

```php
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
```

---

## Step 8 — Create Route

Open:

```
routes/web.php
```

Add:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/todos', [TodoController::class, 'index']);

Route::get('/', function () {
    return view('welcome');
});
```

---

## Step 9 — Create Blade View

Create:

```
resources/views/todos.blade.php
```

### todos.blade.php

```html
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Completed Todos</title>

<!-- Tailwind CSS CDN -->
<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-4xl bg-white shadow-xl rounded-xl p-8">

    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
         Completed Todos
    </h1>

    <p class="text-center text-gray-500 mb-8">
        Tasks fetched from API using Laravel Transporter
    </p>

    <div class="max-h-[500px] overflow-y-auto">
        <ol class="space-y-3">

        @foreach($todos as $todo)
            <li class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition">
                
                <span class="text-green-600 text-lg">✔</span>

                <span class="text-gray-700">
                    {{ $todo['title'] }}
                </span>

            </li>
        @endforeach

        </ol>
    </div>

    <div class="mt-6 text-center text-sm text-gray-400">
        Laravel 12 • Transporter Demo Project
    </div>

</div>

</body>
</html>
```

---

## Step 10 — Run the Application

Start Laravel server.

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000/todos
```

You will see a list of completed TODO items fetched from the API.

---

## Output

<img width="1919" height="1029" alt="Screenshot 2026-03-09 130348" src="https://github.com/user-attachments/assets/e4420357-1dc2-4195-98d1-600435416c5b" />

---

## Project Folder Structure

```
PHP_Laravel12_Transporter
│
├── app
│   ├── Http
│   │   └── Controllers
│   │        └── TodoController.php
│   │
│   └── Transporter
│       ├── JsonPlaceholderRequest.php
│       └── Todos
│            └── GetCompletedTodos.php
│
├── config
│   └── transporter.php
│
├── resources
│   └── views
│        └── todos.blade.php
│
├── routes
│   └── web.php
│
├── .env
├── .env.example
├── composer.json
└── README.md
```

---

Your PHP_Laravel12_Transporter Project is now ready!

