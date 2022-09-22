<?php
namespace App\Interfaces;

interface AuthUserInterface
{
    public function getAllUsers();

    public function createUser(array $usersDetails);

    public function getUser(int $user);

    public function updateUser(int $user, array $userDetails);

    public function deleteUser(int $user);

    public function login($userDetails);

}
