<?php


namespace RbTracker\Parser;


use Doctrine\ORM\EntityManager;
use phpDocumentor\Reflection\Types\Object_;
use phpDocumentor\Reflection\Types\String_;
use RbTracker\entities\Change;
use RbTracker\entities\Connection;
use function GuzzleHttp\Psr7\str;

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

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function parseAndSaveFromXml()
    {
        $errors = [];
        $simpleXmlParser = simplexml_load_string($this->xml);
        foreach ($simpleXmlParser->s as $connection) {
            $fullId = (string)($connection->attributes())['id'];
            $connectionModel = $this->getConnectionModel($fullId);
            if (!$connectionModel) {
                $errors[] = " Nichts gefunden für: " . $fullId;
                continue;
            }

            if ($connection->ar) {
                $this->handleArrivalChange($fullId, $connection->ar, $connectionModel->getId());
            }

            if ($connection->dp) {
                $this->handleDepartureChange($fullId, $connection->ar, $connectionModel->getId());
            }

        }

        $this->em->flush();
        if (count($errors) > 0) {
            return $errors;
        }
        return 1;
    }

    /**
     * @param string $fullId
     * @param $arrival
     * @param $connectionId
     * @throws \Doctrine\ORM\ORMException
     */
    private
    function handleArrivalChange(string $fullId, $arrival, $connectionId)
    {
        $this->buildChange('arrival_change', $fullId, $arrival, $connectionId);

    }

    /**
     * @param string $fullId
     * @param $departure
     * @param $connectionId
     */
    private
    function handleDepartureChange(string $fullId, $departure, $connectionId)
    {
        $this->buildChange('departure_change', $fullId, $departure, $connectionId);
    }

    /**
     * @param string $fullId
     * @return array|object
     */
    private
    function getConnectionModel(string $fullId)
    {
        if (substr($fullId, 0, 1) == '-') {
            $fullId = ltrim($fullId, '-');
        }
        $explodedId = explode('-', $fullId);
        $uniqueId = $explodedId[0];
        $startDateTime = \DateTime::createFromFormat('ymdHi', $explodedId[1]);
        $tripStopNo = $explodedId[2];

        return $this->em->getRepository(Connection::class)->findOneBy([
            'uniqueTripId' => $uniqueId,
            'startDateTime' => $startDateTime,
            'tripStopNo' => $tripStopNo
        ]);

    }

    private
    function checkChange(string $fullId, $type)
    {
        $change = $this->em->getRepository(Change::class)->findOneBy([
            'change_id' => $fullId,
            'type' => $type]);

        if (!$change) {
            $change = new Change();
        }
        return $change;
    }

    /**
     * @param $ct
     * @return \DateTime|false
     */
    private
    function buildTime($ct)
    {
        return \DateTime::createFromFormat('ymdHi', $ct);
    }

    private function buildChange($type, string $fullId, $element, $connectionId)
    {
        if (!$element) {
            return;
        }

        $change = $this->checkChange($fullId, $type);
        $change->setType($type);
        $change->setConnectionId($connectionId);
        $change->setChangeId($fullId);
        $changeTime = (string)($element->attributes())['ct'];
        $changePlatform = (string)($element->attributes())['cp'];
        $changePath = (string)($element->attributes())['cpth'];
        if ($changeTime) {
            $time = $this->buildTime($changeTime);
            $change->setChangedTime($time);
        }

        if ($changePlatform) {
            $change->setChangedPlatform($changePlatform);
        }

        if ($changePath) {
            $change->setChangedPath($changePath);
        }


        $this->em->persist($change);
    }


}