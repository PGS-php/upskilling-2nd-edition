<?php

namespace App\Infrastructure\Adapters\Outgoing\PDO;

use App\Domain\User\User;

class UserRepository implements \App\Domain\Ports\Outgoing\UserRepository
{
    private $db;

    public function __construct(\PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function add(User $user)
    {
        // TODO: Implement add() method.
    }

    public function getByName(string $name)
    {
        // TODO: Implement getByName() method.
    }
}