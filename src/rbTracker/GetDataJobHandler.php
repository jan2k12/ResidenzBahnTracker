<?php


namespace RbTracker;


class GetDataJobHandler
{


    /**
     * @var \DateTime
     */
    private $dateTime;


    /**
     * GetDataJobHandler constructor.
     */
    public function __construct()
    {
        $this->dateTime=(new \DateTime())->modify("-1 hour");

    }

    public function getData()
    {

    }
}