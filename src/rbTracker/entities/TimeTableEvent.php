<?php


namespace RbTracker\entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="timetable_events")
 * Class TimeTableEvent
 * @package RbTracker\entities
 */
class TimeTableEvent
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
     * @var String
     */
    protected $type;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $planedTime;

    /**
     * @ORM\Column(type="integer")
     * @var String
     */
    protected $planedPlatform;

    /**
     * @ORM\Column(type="string",nullable=true)
     * @var string
     */
    protected $toDirection;


    /**
     * @ORM\Column(type="string",nullable=true)
     * @var string
     */
    protected $fromDirection;

    /**
     * @ORM\ManyToOne(targetEntity="Connection",inversedBy="events")
     * @var ArrayCollection
     */
    protected $connections;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return String
     */
    public function getType(): String
    {
        return $this->type;
    }

    /**
     * @return \DateTime
     */
    public function getPlanedTime(): \DateTime
    {
        return $this->planedTime;
    }

    /**
     * @return String
     */
    public function getPlanedPlatform(): String
    {
        return $this->planedPlatform;
    }

    /**
     * @return string
     */
    public function getToDirection(): string
    {
        return $this->toDirection;
    }

    /**
     * @return string
     */
    public function getFromDirection(): string
    {
        return $this->fromDirection;
    }

    /**
     * @return ArrayCollection
     */
    public function getConnections(): ArrayCollection
    {
        return $this->connections;
    }

    /**
     * @param String $type
     */
    public function setType(String $type): void
    {
        $this->type = $type;
    }

    /**
     * @param \DateTime $planedTime
     */
    public function setPlanedTime(\DateTime $planedTime): void
    {
        $this->planedTime = $planedTime;
    }

    /**
     * @param String $planedPlatform
     */
    public function setPlanedPlatform(String $planedPlatform): void
    {
        $this->planedPlatform = $planedPlatform;
    }

    /**
     * @param string $toDirection
     */
    public function setToDirection(string $toDirection): void
    {
        $this->toDirection = $toDirection;
    }

    /**
     * @param string $fromDirection
     */
    public function setFromDirection(string $fromDirection): void
    {
        $this->fromDirection = $fromDirection;
    }

    /**
     * @param ArrayCollection $connections
     */
    public function setConnections(ArrayCollection $connections): void
    {
        $this->connections = $connections;
    }


}