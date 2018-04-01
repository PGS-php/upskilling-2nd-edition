<?php declare(strict_types=1);

namespace App\Domain\User;

interface UserRegistry
{
    /**
     * @return array|User[]
     */
    public function getAll(): array;

    /**
     * @param User $user
     * @throws UserAlreadyExistException
     */
    public function add(User $user): void;

    /**
     * @param string $name
     * @return array
     */
    public function getByName(string $name): array;
}
