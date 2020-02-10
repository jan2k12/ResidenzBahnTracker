<?php


namespace RbTracker\entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="connections")
 * Class Connection
 * @package RbTracker\entities
 */
class Connection
{
    /**
     * ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="int")
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
     * @ORM\OneToOne(inversedBy="connection_id")
     * @var TripLabel
     */
    protected $tripLabel;
}