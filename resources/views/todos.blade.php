<!DOCTYPE html>
<html>
<head>
    <title>Todos Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen">

<div class="max-w-5xl mx-auto p-6">

    <!-- HEADER -->
    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📋 Todos Dashboard</h1>
        <p class="text-gray-500">Laravel 12 Transporter + API Integration</p>
    </div>

    <!-- SEARCH BAR -->
    <form method="GET" class="bg-white p-4 rounded-xl shadow flex gap-3 mb-6">

        <input type="text"
               name="search"
               value="{{ $search ?? '' }}"
               placeholder="Search todos..."
               class="w-full border p-2 rounded-lg">

        <select name="completed" class="border p-2 rounded-lg">
            <option value="">All</option>
            <option value="1" {{ request('completed') == '1' ? 'selected' : '' }}>Completed</option>
            <option value="0" {{ request('completed') == '0' ? 'selected' : '' }}>Pending</option>
        </select>

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Filter
        </button>

    </form>

    <!-- LIST -->
    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="font-semibold mb-4 text-gray-700">Todo List</h2>

        <div class="space-y-3">
            @forelse($todos as $todo)

                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">

                    <span class="text-gray-700">
                        {{ $todo['title'] }}
                    </span>

                    @if($todo['completed'])
                        <span class="text-green-600 font-semibold">✔ Done</span>
                    @else
                        <span class="text-red-500 font-semibold">Pending</span>
                    @endif

                </div>

            @empty
                <p class="text-center text-gray-500">No todos found</p>
            @endforelse
        </div>

    </div>

    <!-- PAGINATION -->
    <div class="flex justify-center gap-2 mt-6">

        @for($i = 1; $i <= $pages; $i++)
            <a href="?page={{ $i }}&search={{ $search }}"
               class="px-4 py-2 rounded-lg border {{ $page == $i ? 'bg-blue-600 text-white' : 'bg-white' }}">
                {{ $i }}
            </a>
        @endfor

    </div>

</div>

</body>
</html>