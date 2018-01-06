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
    protected $create;
    protected $update;

    /** @var User */
    protected $user;

    public function __construct(string $name, Status $status, ?\DateTime $create = null, ?\DateTime $update = null)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->status = $status;
        $this->create = $this->setDate($create);
        $this->update = $this->setDate($update);
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

    public function getCreate(): \DateTime
    {
        return $this->create;
    }

    public function getUpdate(): \DateTime
    {
        return $this->update;
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

    private function setDate(?\DateTime $date): \DateTime
    {
        return null === $date ? new \DateTime('now') : $date;
    }
}
