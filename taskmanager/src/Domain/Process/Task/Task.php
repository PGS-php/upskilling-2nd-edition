<?php declare(strict_types=1);

namespace App\Domain\Process\Task;

use App\Domain\Process\User\UnassignedUserException;
use App\Domain\Process\User\User;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Task
{
    public const DATE_FORMAT = 'Y-m-d H:i:s';
    public const PRIORITY_TRIVIAL = 'Trivial';
    public const PRIORITY_MINOR = 'Minor';
    public const PRIORITY_MAJOR = 'Major';
    public const PRIORITY_CRITICAL = 'Critical';
    public const PRIORITY_BLOCKER = 'Blocker';

    protected $id;
    protected $name;
    protected $status;
    protected $createdAt;
    protected $updatedAt;
    protected $priority;

    /** @var User */
    protected $user;

    public function __construct(string $name, Status $status)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->status = $status;
        $this->createdAt = new \DateTime();
        $this->update();
        $this->priority = self::PRIORITY_MAJOR;
    }

    public function getPriorities(): array
    {
        return [
            self::PRIORITY_TRIVIAL => self::PRIORITY_TRIVIAL,
            self::PRIORITY_MINOR => self::PRIORITY_MINOR,
            self::PRIORITY_MAJOR => self::PRIORITY_MAJOR,
            self::PRIORITY_CRITICAL => self::PRIORITY_TRIVIAL,
            self::PRIORITY_BLOCKER => self::PRIORITY_BLOCKER,
        ];
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function changeStatusByUser(Status $status, User $user): void
    {
        if ($this->status->equals($status)) {
            return;
        }

        if ($this->status->equals(Status::closed())) {
            throw UnexpectedStatusChangeException::createForClosedStatus();
        }

        $this->status = $status;

        if ($this->status->equals(Status::inProgress())) {
            $this->assign($user);
        } elseif ($this->status->equals(Status::toDo())) {
            $this->unassign();
        }
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

    public function unassign(): void
    {
        $this->user = null;
    }

    public function hasAssignment(): bool
    {
        return $this->user !== null;
    }

    public function getPriority(): string
    {
        return $this->priority;
    }

    public function setPriority(string $priority): void
    {
        if (!isset($this->getPriorities()[$priority])) {
            throw new \InvalidArgumentException(sprintf("'%s' priority does not exists!", $priority));
        }

        $this->priority = $priority;
    }

    private function update(): void
    {
        $this->updatedAt = new \DateTime();
    }
}
