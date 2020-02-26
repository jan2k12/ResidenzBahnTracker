<?php


namespace RbTracker\entities;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="changes")
 * Class Change
 * @package RbTracker\entities
 */
class Change
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $connection_id;

    /**
     * @ORM\Column(type="string",nullable=true)
     * @var string
     */
    protected $change_id;


    /**
     * @ORM\Column(type="datetime",nullable=true)
     * @var \DateTime
     */
    protected $changedTime;

    /**
     * @ORM\Column(type="string",nullable=true)
     * @var string
     */
    protected $changedPath;

    /**
     * @ORM\Column(type="integer",nullable=true)
     * @var int
     */
    protected $changedPlatform;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $type;


    /**
     * Change constructor.
     */
    public function __construct()
    {

    }


    /**
     * @return string
     */
    public function getChangeId(): string
    {
        return $this->change_id;
    }

    /**
     * @param string $change_id
     */
    public function setChangeId(string $change_id): void
    {
        $this->change_id = $change_id;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connection_id;
    }

    /**
     * @param string $connection_id
     */
    public function setConnectionId(string $connection_id): void
    {
        $this->connection_id = $connection_id;
    }

    /**
     * @return \DateTime
     */
    public function getChangedTime(): \DateTime
    {
        return $this->changedTime;
    }

    /**
     * @param \DateTime $changedTime
     */
    public function setChangedTime(\DateTime $changedTime): void
    {
        $this->changedTime = $changedTime;
    }

    /**
     * @return string
     */
    public function getChangedPath(): string
    {
        return $this->changedPath;
    }

    /**
     * @param string $changedPath
     */
    public function setChangedPath(string $changedPath): void
    {
        $this->changedPath = $changedPath;
    }

    /**
     * @return int
     */
    public function getChangedPlatform(): int
    {
        return $this->changedPlatform;
    }

    /**
     * @param int $changedPlatform
     */
    public function setChangedPlatform(int $changedPlatform): void
    {
        $this->changedPlatform = $changedPlatform;
    }

    /**
     * @return string
     */
    public function getChangedStatus(): string
    {
        return $this->changedStatus;
    }

    /**
     * @param string $changedStatus
     */
    public function setChangedStatus(string $changedStatus): void
    {
        $this->changedStatus = $changedStatus;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return ArrayCollection
     */
    public function getMessages(): ArrayCollection
    {
        return $this->messages;
    }

    /**
     * @param ArrayCollection $messages
     */
    public function setMessages(ArrayCollection $messages): void
    {
        $this->messages = $messages;
    }



}