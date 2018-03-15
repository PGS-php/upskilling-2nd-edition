<?php

namespace App\Domain\Ports\Outgoing;

use App\Domain\Process\User\User;

interface UserRepository
{
    public function userExist(User $user);
}