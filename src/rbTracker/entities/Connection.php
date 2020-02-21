<?php


namespace RbTracker\entities;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ConnectionRepository")
 * @ORM\Table(name="connections")
 * Class Connection
 * @package RbTracker\entities
 */
class Connection
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="bigint")
     * @var int
     */
    protected $uniqueTripId;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    protected $startDateTime;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $tripStopNo;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $station;


    /**
     * @ORM\ManyToOne(targetEntity="TripLabel",inversedBy="connections")
     * @var TripLabel
     */
    protected $tripLabel;

    /**
     * @ORM\OneToMany(targetEntity="TimeTableEvent", mappedBy="connection")
     * @var ArrayCollection
     */
    protected $events;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $this->events=new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getStation(): string
    {
        return $this->station;
    }

    /**
     * @param string $station
     */
    public function setStation(string $station): void
    {
        $this->station = $station;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUniqueTripId(): int
    {
        return $this->uniqueTripId;
    }

    /**
     * @param int $uniqueTripId
     */
    public function setUniqueTripId(int $uniqueTripId): void
    {
        $this->uniqueTripId = $uniqueTripId;
    }

    /**
     * @return \DateTime
     */
    public function getStartDateTime(): \DateTime
    {
        return $this->startDateTime;
    }

    /**
     * @param \DateTime $startDateTime
     */
    public function setStartDateTime(\DateTime $startDateTime): void
    {
        $this->startDateTime = $startDateTime;
    }

    /**
     * @return int
     */
    public function getTripStopNo(): int
    {
        return $this->tripStopNo;
    }

    /**
     * @param int $tripStopNo
     */
    public function setTripStopNo(int $tripStopNo): void
    {
        $this->tripStopNo = $tripStopNo;
    }

    /**
     * @return TripLabel
     */
    public function getTripLabel(): TripLabel
    {
        return $this->tripLabel;
    }

    /**
     * @param TripLabel $tripLabel
     */
    public function setTripLabel(TripLabel $tripLabel): void
    {
        $this->tripLabel = $tripLabel;
    }


    
}