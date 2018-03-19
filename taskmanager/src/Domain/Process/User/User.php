<?php

namespace App\Domain\Process\User;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class User
{
    /** @var string */
    private $id;

    /** @var string */
    private $firstName;

    public function __construct(string $firstName)
    {
        $this->id = Uuid::uuid4();
        $this->firstName = $firstName;
    }

    public function __toString()
    {
        return $this->firstName;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }
}
