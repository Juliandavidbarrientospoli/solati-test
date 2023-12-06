<!-- resources/views/create.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>
<body>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <h2>Crear Nuevo Usuario</h2>

        @if(session('message'))
            <p class="success-message">{{ session('message') }}</p>
        @endif

        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Crear Usuario</button>
    </form>

</body>
</html>
