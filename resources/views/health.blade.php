<!DOCTYPE html>
<html>
<head>
    <title>API Health</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow text-center">
        <h1 class="text-xl font-bold mb-4">API Health Status</h1>
        <div class="p-4 {{ $status == 'Online' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} rounded-lg font-bold">
            Status: {{ $status }}
        </div>
        <p class="mt-4 text-gray-600">Latency: {{ $latency }} ms</p>
        <a href="/todos" class="block mt-6 text-blue-600 hover:underline">Back to Todos</a>
    </div>
</body>
</html>