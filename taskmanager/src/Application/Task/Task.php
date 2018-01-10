<?php declare(strict_types=1);

namespace App\Application\Task;

use App\Application\User\UnassignedUserException;
use App\Application\User\User;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Task
{
    protected $id;
    protected $name;
    protected $status;
    protected $createdAt;
    protected $updatedAt;

    public const DATE_FORMAT = 'Y-m-d H:i:s';

    /** @var User */
    protected $user;

    public function __construct(string $name, Status $status)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->status = $status;
        $this->createdAt = new \DateTime();
        $this->update();
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

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
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
        $this->update();
    }

    public function hasAssignment(): bool
    {
        return $this->user !== null;
    }

    private function update(): void
    {
        $this->updatedAt = new \DateTime();
    }
}
