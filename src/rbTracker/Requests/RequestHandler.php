<?php


namespace RbTracker\Requests;


class RequestHandler
{
    /**
     * @var \DateTime
     */
    private $dateTime=null;
    /**
     * @var array
     */
    private $stations=[];

    /**
     * RequestHandler constructor.
     * @param \DateTime $dateTime
     * @param array $stations
     */
    public function __construct(\DateTime $dateTime=null,array $stations=null)
    {
        $this->dateTime=$dateTime;
        $this->stations=$stations;
    }

    public function getRequestResult(string $requestTyp=null)
    {
        if(!$requestTyp){
            $requestTyp=new LastHourAllStationsRequest();
        }
    }
}