<?php declare(strict_types=1);

namespace App\Infrastructure\InMemory;

use App\Application\User\User;
use App\Application\User\UserRegistry as BaseUserRegistry;

class UserRegistry implements BaseUserRegistry
{
    private $users = [];

    /**
     * @inheritdoc
     */
    public function getAll(): array
    {
        return $this->users;
    }

    public function add(User $user): void
    {
        $this->users[(string) $user->getId()] = $user;
    }

    public function getByName(string $name): array
    {
        return array_filter($this->users, function (User $user) use ($name) {
            return $name === (string) $user;
        });
    }
}
