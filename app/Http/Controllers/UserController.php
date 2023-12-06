<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\DAO\UserDAO;

class UserController extends Controller
{
    private $userDAO;

    /**
     * Constructor to inject the UserDAO dependency.
     *
     * @param UserDAO $userDAO
     */
    public function __construct(UserDAO $userDAO)
    {
        $this->userDAO = $userDAO;
    }

       /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse|\Illuminate\View\View
     */

    public function getAllUsersJson()
    {
        $users = $this->userDAO->getAllUsers();
    
        return response()->json(['users' => $users]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
    $termId = $request->input('search_id');

    if ($termId) {
        $user = $this->userDAO->getUserById($termId);

        if ($user) {
            return new JsonResponse(['user' => $user]);
        } else {
            return new JsonResponse(['message' => 'User not found'], 404);
        }
    }

    $users = $this->userDAO->getAllUsers();

    if ($users->isEmpty()) {
        // Si no hay usuarios, redirige a la vista de creación
        return redirect()->route('users.create');
    }

    return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Get and load a user by ID for editing
        $user = $this->userDAO->getUserById($id);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'required',
        ]);

        // Update user data with the validated data
        $updatedUser = $this->userDAO->updateUser($id, [
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        if ($updatedUser) {
            return redirect()->route('users.index')->with('message', 'User updated successfully');
        } else {
            return redirect()->route('users.index')->with('message', 'User not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Delete a user by ID
        $deleted = $this->userDAO->deleteUser($id);

        if ($deleted) {
            return redirect()->route('users.index')->with('message', 'User deleted successfully');
        } else {
            return redirect()->route('users.index')->with('message', 'User not found');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Load the view to create a new user
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data to create a new user
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
        ]);

        // Create a new user with the validated data
        $newUser = $this->userDAO->createUser([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('users.index')->with('message', 'User created successfully');
    }
}
