<?php

namespace App\Services;

use App\Interfaces\AuthUserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * AuthUserService
 */
class AuthUserService implements AuthUserInterface
{

    /**
     * getAllUsers
     *
     * @return void
     */
    public function getAllUsers()
    {
        return User::all();
    }

    /**
     * getUser
     *
     * @param  mixed $User
     * @return void
     */
    public function getUser($User)
    {
         $User = User::find($User);
         if($User){
            return $User;
         }
         return false;
    }

    /**
     * getUserByEmail
     *
     * @param  mixed $userEmail
     * @return void
     */
    public function getUserByEmail($userEmail)
    {
        return User::where('email', $userEmail)->first();
    }

    /**
     * getUserByUsername
     *
     * @param  mixed $username
     * @return void
     */
    public function getUserByUsername($username)
    {
        return User::where('username', $username)->first();
    }

    /**
     * createUser
     *
     * @param  mixed $UsersDetails
     * @return void
     */
    public function createUser(array $UsersDetails)
    {
        return User::create($UsersDetails);
    }

    /**
     * updateUser
     *
     * @param  mixed $User
     * @param  mixed $UserDetails
     * @return void
     */
    public function updateUser($User, array $UserDetails)
    {
        return User::whereId($User)->update($UserDetails);
    }

    /**
     * deleteUser
     *
     * @param  mixed $User
     * @return void
     */
    public function deleteUser($User)
    {
        return User::destroy($User);
    }

    /**
     * login
     *
     * @param  mixed $UserDetails
     * @return void
     */
    public function login($UserDetails)
    {
        return Auth::attempt($UserDetails);
    }

}
