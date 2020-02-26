<?php


namespace RbTracker\Requests;


class LastHourAllStationsChangesRequest extends AbstractBasicRequest
{
    const QUERY_STRING = "fchg/{evaNo}";


    protected $uri = "timetables/v1/";


    /**
     * LastHourAllStationsRequest constructor.
     */
    public function __construct()
    {
        $this->buildConfig();
    }


    public function getRequestResult()
    {
        $evaNo = 8000299;
        $queryStr = preg_replace('/\{evaNo\}/', $evaNo, self::QUERY_STRING);
        $this->uri .= $queryStr;
        return parent::getRequestResult();


    }
}