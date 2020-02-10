<?php


namespace RbTracker\Parser;


use function GuzzleHttp\Psr7\str;

class ConnectionSaver
{
    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    private $xml;

    /**
     * ConnectionSaver constructor.
     * @param \Psr\Http\Message\StreamInterface $connectionResultXml
     */
    public function __construct(\Psr\Http\Message\StreamInterface $connectionResultXml)
    {
        $this->xml = $connectionResultXml;
    }

    public function parseAndSaveFromXml()
    {
        $simpleXmlParser = simplexml_load_string($this->xml);
        $station = (string)($simpleXmlParser->attributes())['station'];
        foreach ($simpleXmlParser->s as $connection) {
            $fullId = (string)($connection->attributes())['id'];
            $explodedId = explode('-', $fullId);
            $uniqueId = $explodedId[0];
            $startDateTime = new \DateTime($explodedId[1]);
            $tripStopNo = $explodedId[2];
            if ($arrival = $connection->children('ar')) {
                $arrivalAttributes = $arrival->attributes();
                $planedArrival = (string)$arrivalAttributes['pt'];
                $plannedPlatform = (string)$arrivalAttributes['pp'];
                $directionArray = (explode('|', (string)$arrivalAttributes['ppth']));
                $fromDirection = $directionArray[count($directionArray) - 1];
            }
            if ($departure = $connection->children('dp')) {
                $departureAttributes = $departure->attributes();
                $planedDeparture = (string)$departureAttributes['pt'];
                $plannedDepaturePlatform = (string)$departureAttributes['pp'];
                $directionArray = (explode('|', (string)$departureAttributes['ppth']));
                $toDirection = $directionArray[count($directionArray) - 1];
            }
            if ($triplabel = $connection->children('tl')) {
                $tripLabelAttributes = $departure->attributes();
                $organisation = (string)$tripLabelAttributes['o'];
                $type= (string)$departureAttributes['c'];
                $number=(string)$departureAttributes['n'];
            }
        }

    }
}