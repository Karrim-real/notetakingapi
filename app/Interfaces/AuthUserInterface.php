<?php
namespace App\Interfaces;

interface AuthUserInterface
{
    /**
     * getAllUsers
     *
     * @return void
     */
    public function getAllUsers();

    /**
     * createUser
     *
     * @param  mixed $usersDetails
     * @return void
     */
    public function createUser(array $usersDetails);

    /**
     * getUser
     *
     * @param  mixed $user
     * @return void
     */
    public function getUser(int $user);

    /**
     * updateUser
     *
     * @param  mixed $user
     * @param  mixed $userDetails
     * @return void
     */
    public function updateUser(int $user, array $userDetails);

    /**
     * deleteUser
     *
     * @param  mixed $user
     * @return void
     */
    public function deleteUser(int $user);

    /**
     * login
     *
     * @param  mixed $userDetails
     * @return void
     */
    public function login($userDetails);

}
