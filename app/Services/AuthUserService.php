<?php

namespace App\Services;

use App\Interfaces\AuthUserInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthUserService implements AuthUserInterface
{

    public function getAllUsers()
    {
        return User::all();
    }

    public function getUser($User)
    {
         $User = User::find($User);
         if($User){
            return $User;
         }
         return false;
    }

    public function getUserByEmail($userEmail)
    {
        return User::where('email', $userEmail)->first();
    }

    public function createUser(array $UsersDetails)
    {
        return User::create($UsersDetails);
    }

    public function updateUser($User, array $UserDetails)
    {
        return User::whereId($User)->update($UserDetails);
    }

    public function deleteUser($User)
    {
        return User::destroy($User);
    }

    public function login($UserDetails)
    {
        return Auth::attempt($UserDetails);
    }

}
