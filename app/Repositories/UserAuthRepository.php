<?php

namespace App\Repositories;

use App\Models\User;

class UserAuthRepository
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function buildUser ($data)
    {
        $this->user->id = $data['id'];
        $this->user->name = $data['name'];
        $this->user->lastname = $data['lastname'];
        $this->user->email = $data['email'];
        $this->user->password = $data['password'];
        $this->user->image = $data['image'];
        $this->user->bio = $data['bio'];
        $this->user->token = $data['token'];

        return $this->user;
    }
    public function emailExists($email)
    {
        return User::where('email', $email)->exists();
    }
}