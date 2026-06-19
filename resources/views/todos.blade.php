<!DOCTYPE html>
<html>
<head>
    <title>Todos Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen p-6">

<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-xl shadow p-6 mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📋 Todos Dashboard</h1>
            <p class="text-gray-500">Laravel 12 Transporter + API Integration</p>
        </div>
        <a href="{{ url('/health') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold">API Health Check</a>
    </div>

    <form method="POST" action="{{ route('todos.store') }}" class="bg-white p-6 rounded-xl shadow mb-6">
        @csrf
        <div class="flex gap-3">
            <input type="text" name="title" required placeholder="Enter new todo title..." class="w-full border p-3 rounded-lg outline-none focus:border-blue-500">
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-bold">Add Todo</button>
        </div>
    </form>

    <form method="GET" class="bg-white p-4 rounded-xl shadow flex gap-3 mb-6">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search todos..." class="w-full border p-2 rounded-lg">
        <select name="completed" class="border p-2 rounded-lg">
            <option value="">All</option>
            <option value="1" {{ request('completed') == '1' ? 'selected' : '' }}>Completed</option>
            <option value="0" {{ request('completed') == '0' ? 'selected' : '' }}>Pending</option>
        </select>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">Filter</button>
    </form>

    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold mb-4 text-gray-700">Todo List</h2>
        <div class="space-y-3">
           @forelse($todos as $todo)
    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100">
        <span class="{{ $todo['completed'] ? 'line-through text-gray-400' : '' }}">{{ $todo['title'] }}</span>
        
        @if(!$todo['completed'])
            <form action="{{ route('todos.update', $todo['id']) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" class="text-blue-600 font-bold hover:underline">Mark Done</button>
            </form>
        @else
            <span class="text-green-600 font-semibold">✔ Done</span>
        @endif
    </div>
@empty
    <p>No todos found</p>
@endforelse
        </div>
    </div>
</div>

</body>
</html>