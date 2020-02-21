<?php


namespace RbTracker\Parser;


use Doctrine\ORM\EntityManager;
use RbTracker\entities\Connection;

class ChangeSaver
{

    /**
     * @var \Psr\Http\Message\StreamInterface
     */
    private $xml;
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * ConnectionSaver constructor.
     * @param \Psr\Http\Message\StreamInterface $changeResultXml
     */
    public function __construct(\Psr\Http\Message\StreamInterface $changeResultXml)
    {
        $this->xml = $changeResultXml;
        $this->em = $GLOBALS['entityManager'];
    }

    public function parseAndSaveFromXml()
    {
        $simpleXmlParser = simplexml_load_string($this->xml);
        foreach ($simpleXmlParser->s as $connection) {
            $fullId = (string)($connection->attributes())['id'];
            if (substr($fullId, 0, 1) == '-') {
                $fullId = ltrim($fullId, '-');
            }
            $explodedId = explode('-', $fullId);
            $uniqueId = $explodedId[0];
            $startDateTime = \DateTime::createFromFormat('ymdHi', $explodedId[1]);
            $tripStopNo = $explodedId[2];

            $connectionModel = $this->em->getRepository(Connection::class)->findOneBy([
                'uniqueTripId' => $uniqueId,
                'startDateTime' => $startDateTime->format('Y-m-d H:i:s'),
                'tripStopNo'=>$tripStopNo
                ]);
            if(!$connectionModel){
                $errors[]=" Nichts gefunden für: ".$fullId;
            }


        }
    }
}