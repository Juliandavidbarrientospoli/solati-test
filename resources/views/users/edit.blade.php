<!-- resources/views/edit.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
</head>
<body>

    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <h2>Editar Usuario</h2>

        @if(session('message'))
            <p class="success-message">{{ session('message') }}</p>
        @endif

        <div>
            <label for="username">Nuevo Username:</label>
            <input type="text" name="username" id="username" value="{{ $user->username }}" required>
        </div>

        <div>
            <label for="password">Nuevo Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Actualizar Usuario</button>
    </form>

</body>
</html>
