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