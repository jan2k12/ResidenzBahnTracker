<?php


namespace RbTracker\Requests;


use GuzzleHttp\Psr7\Request;

class LastHourAllStationsRequest extends AbstractBasicRequest
{
    const QUERY_STRING = "plan/{evaNo}/{date}/{hour}";

    /**
     * @var \DateTime
     */
    private $lastHourDate;

    protected $uri = "timetables/v1/";


    /**
     * LastHourAllStationsRequest constructor.
     */
    public function __construct()
    {
        $this->lastHourDate = (new \DateTime())->modify('-1 hour');
        $this->buildConfig();
    }


    public function getRequestResult()
    {
        $evaNo = 8000299;
        $queryStr = preg_replace(['/\{evaNo\}/', '/\{date\}/', '/\{hour\}/'], [$evaNo, $this->lastHourDate->format('ymd'), $this->lastHourDate->format('H')], self::QUERY_STRING);
        $this->uri .= $queryStr;
        return parent::getRequestResult();


    }


}