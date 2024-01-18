<?php

namespace App\Repositories;

use App\Models\User;

class UserAuthRepository
{
    public function __construct(User $user)
    {
    }

    public function buildUser ($data)
    {
        $user = new User();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->image = $data['image'];
        $user->bio = $data['bio'];
        $user->token = $data['token'];

        return $user;
    }
    public function emailExists($email)
    {
        return User::where('email', $email)->exists();
    }
}