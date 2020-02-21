<?php


namespace RbTracker\entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="triplabels")
 * Class TripLabel
 * @package RbTracker\entities
 */
class TripLabel
{



    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Connection",mappedBy="tripLabel")
     * @var ArrayCollection
     */
    protected $connections;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    protected $organisation;

    /**
     * @ORM\Column(type="string")
     * @var String
     */
    protected $type;

    /**
     * @ORM\Column(type="integer")
     * @var String
     */
    protected $number;

    /**
     * TripLabel constructor.
     */
    public function __construct()
    {
        $this->connections = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return ArrayCollection
     */
    public function getConnections(): ArrayCollection
    {
        return $this->connections;
    }

    /**
     * @param ArrayCollection $connections
     */
    public function setConnections(ArrayCollection $connections): void
    {
        $this->connections = $connections;
    }

    /**
     * @return String
     */
    public function getOrganisation(): String
    {
        return $this->organisation;
    }

    /**
     * @param String $organisation
     */
    public function setOrganisation(String $organisation): void
    {
        $this->organisation = $organisation;
    }

    /**
     * @return String
     */
    public function getType(): String
    {
        return $this->type;
    }

    /**
     * @param String $type
     */
    public function setType(String $type): void
    {
        $this->type = $type;
    }

    /**
     * @return String
     */
    public function getNumber(): String
    {
        return $this->number;
    }

    /**
     * @param String $number
     */
    public function setNumber(String $number): void
    {
        $this->number = $number;
    }


    public function addConnection(Connection $con){
        $this->connections->add($con);
    }

}