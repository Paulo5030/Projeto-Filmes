<?php

namespace App\Services\Contracts;

interface AuthInterface
{
    public function create(array $data);
    public function updateUser(array $data);
    public function updatePassword(array $data);


}