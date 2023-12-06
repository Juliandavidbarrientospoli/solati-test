<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>

    <h2>Lista de Usuarios</h2>

    <!-- Form get all json users -->
    <form action="{{ route('users.json') }}" method="GET" class="form-inline">
        <a href="{{ route('users.create') }}" class="create-link">Crear nuevo usuario</a>
        <button type="submit" class="json-button">Ver Usuarios</button> 
    </form>

    <!-- Form search by id -->
    <form action="{{ route('users.index') }}" method="GET" class="form">
        <div class="form-group">
            <label for="search_id">Buscar por ID:</label>
            <input type="text" name="search_id" id="search_id" required>
            <button type="submit">Enviar</button>
        </div>
    </form>

    <!-- Table users-->
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->password }}</td>
                    <td class="actions">
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}">Editar</a>
                        <a href="{{ route('users.destroy', ['user' => $user->id]) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">Eliminar</a>
                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', ['user' => $user->id]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay usuarios registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
