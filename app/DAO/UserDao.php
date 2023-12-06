<?php

namespace App\DAO;

use App\Models\User;

class UserDAO
{
    // Get all users from the database
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * Get a user by their ID
     *
     * @param int $id The user ID
     * @return User|null The user model instance or null if not found
     */
    public function getUserById($id)
    {
        return User::find($id);
    }

    /**
     * Create a new user
     *
     * @param array $data The user data
     * @return User The created user model instance
     */
    public function createUser($data)
    {
        return User::create($data);
    }

    /**
     * Update a user
     *
     * @param int $id The user ID
     * @param array $data The updated user data
     * @return User|null The updated user model instance or null if not found
     */
    public function updateUser($id, $data)
    {
        // Find the user by ID
        $user = User::find($id);

        if ($user) {
            // Update the user data
            $user->update($data);
            return $user;
        }

        return null;
    }

    /**
     * Delete a user
     *
     * @param int $id The user ID
     * @return bool True if the user was deleted successfully, false otherwise
     */
    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }
}
