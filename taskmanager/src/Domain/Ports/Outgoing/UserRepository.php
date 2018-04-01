<?php

namespace App\Domain\Ports\Outgoing;

use App\Domain\User\User;

interface UserRepository
{
    public function getAll();

    public function add(User $user);

    public function getByName(string $name);
}