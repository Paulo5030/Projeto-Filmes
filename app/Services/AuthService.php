<?php

namespace App\Services;

use App\Repositories\UserAuthRepository;
use App\Models\User;
use App\Services\Contracts\AuthInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthInterface
{
    public function __construct(protected UserAuthRepository $userAuthRepository,
                                protected MessageService $messageService
    )
    {
    }

    public function create(array $data)
    {
        if ($data['type'] === "register") {
            $name = $data['name'] ?? null;
            $lastname = $data['lastname'] ?? null;
            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;
            $confirmpassword = $data['confirmpassword'] ?? null;
            if (!$name || !$lastname || !$password || !$confirmpassword) {
                $this->messageService->getMessagefiels();
                return false;
            }
            if ($password != $confirmpassword) {
                $this->messageService->passwordsNotSame();
                return false;
            }
            if ($this->userAuthRepository->emailExists($email)) {
                $this->messageService->validateEmails();
                return false;
            }
           return $this->messageService->setWelcomeMessage($name);

        }
        return false;
    }

    public function updateUser(array $data)
    {
        if ( $data['type'] === 'update') {
            $userId = auth()->id();
            $user = User::find($userId);

            if ($user) {
                $user->name = $data['name'] ?? $user->name;
                $user->lastname = $data['lastname'] ?? $user->lastname;
                $user->email = $data['email'] ?? $user->email;
                $user->bio = $data['bio'] ?? $user->bio;

                $image = $data['image'] ?? null;
                if ($image && $image->isValid()) {
                    $path = $image->store('public/img/users');
                    $user->image = str_replace('public/', 'storage/', $path);
                }
                $user->save();
                $this->messageService->messageupdateUser();
                return true;
            }
        }
        $this->messageService->messageErrorUpdateUser();
        return false;
        }
    public function updatePassword(array $data)
    {
        if ($data['type'] === 'changepassword') {
            $password = $data['password'] ?? null;
            $confirmpassword = $data['confirmpassword'] ?? null;

            if (!$password || !$confirmpassword) {
               return $this->messageService->getMessagefiels();
            }
            if ($password !== $confirmpassword) {
                return $this->messageService->passwordsNotSame();
            }
            $userId = auth()->id();
            $user = User::find($userId);

            if ($user) {
                $user->password = Hash::make($password);
                $user->save();
                $this->messageService->messageupdatePassword();
                return true;
            }
        }
        $this->messageService->messageErrorupdatePassword();
        return false;
    }

}
