<?php declare(strict_types=1);

namespace App\Application\Task;

use App\Application\User\UnassignedUserException;
use App\Application\User\User;
use App\Application\User\UserAlreadyExistException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Task
{
    protected $name;
    protected $id;
    protected $status;

    /** @var User */
    protected $user;

    public function __construct(string $name, Status $status)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->status = $status;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    public function assigned(): User
    {
        if ($this->hasAssignment()) {
            return $this->user;
        }

        throw new UnassignedUserException();
    }

    public function assign(User $user): void
    {
        $this->user = $user;
    }

    public function hasAssignment(): bool
    {
        return $this->user !== null;
    }
}
