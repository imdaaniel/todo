<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO App</title>
    @vite('resources/css/app.css')
</head>
<body>
    <header class="bg-gray-800 text-white p-4">
        <h1 class="text-center">TODO App</h1>
    </header>

    @yield('content')
</body>
</html>