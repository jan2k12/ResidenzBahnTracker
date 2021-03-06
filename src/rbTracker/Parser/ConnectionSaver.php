<?php


namespace RbTracker\Parser;


use Doctrine\ORM\EntityManager;
use RbTracker\entities\Connection;
use RbTracker\entities\TimeTableEvent;
use RbTracker\entities\TripLabel;


class ConnectionSaver
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
     * @param \Psr\Http\Message\StreamInterface $connectionResultXml
     */
    public function __construct(\Psr\Http\Message\StreamInterface $connectionResultXml)
    {
        $this->xml = $connectionResultXml;
        $this->em = $GLOBALS['entityManager'];
    }

    public function parseAndSaveFromXml()
    {
        $simpleXmlParser = simplexml_load_string($this->xml);
        $station = (string)($simpleXmlParser->attributes())['station'];
        foreach ($simpleXmlParser->s as $connection) {

            $fullId = (string)($connection->attributes())['id'];
            if(substr($fullId,0,1)=='-'){
                $fullId=ltrim($fullId,'-');
            }
            $explodedId = explode('-', $fullId);
            $uniqueId = $explodedId[0];
            $startDateTime = \DateTime::createFromFormat('ymdHi', $explodedId[1]);
            $tripStopNo = $explodedId[2];

            $connectionModel = $this->em->getRepository(Connection::class)->findOneBy([
                'uniqueTripId' => $uniqueId,
                'startDateTime' => $startDateTime,
                'tripStopNo' => $tripStopNo
            ]);
            if (!$connectionModel) {
                $connectionModel = new Connection();
            }
            $connectionModel->setStartDateTime($startDateTime);
            $connectionModel->setTripStopNo($tripStopNo);
            $connectionModel->setUniqueTripId((integer)$uniqueId);
            $connectionModel->setStation($station);
            if ($triplabel = $connection->tl) {
                $tripLabelAttributes = $triplabel->attributes();
                $organisation = (string)$tripLabelAttributes['o'];
                $type = (string)$tripLabelAttributes['c'];
                $number = (string)$tripLabelAttributes['n'];

                $triplabelModel = $this->em->getRepository(TripLabel::class)->findOneBy(['type' => $type,'number'=>$number,'organisation'=>$organisation]);
                if (!$triplabelModel) {
                    $triplabelModel = new TripLabel();
                }

                $triplabelModel->setType($type);
                $triplabelModel->setNumber($number);
                $triplabelModel->setOrganisation($organisation);
                $connectionModel->setTripLabel($triplabelModel);
                $triplabelModel->addConnection($connectionModel);
                $this->em->persist($triplabelModel);
            }

            if ($arrival = $connection->ar) {
                $arrivalAttributes = $arrival->attributes();
                $planedArrival = \DateTime::createFromFormat('ymdHi',(string)$arrivalAttributes['pt']);
                $plannedPlatform = (string)$arrivalAttributes['pp'];
                $directionArray = (explode('|', (string)$arrivalAttributes['ppth']));
                $fromDirection = $directionArray[count($directionArray) - 1];

                $event=new TimeTableEvent();
                $event->setType('arrival');
                $event->setPlanedPlatform($plannedPlatform);
                $event->setPlanedTime($planedArrival);
                $event->setFromDirection($fromDirection);
                $event->setConnection($connectionModel);
                $this->em->persist($event);

            }
            if ($departure = $connection->dp) {
                $departureAttributes = $departure->attributes();
                $planedDeparture = \DateTime::createFromFormat('ymdHi',(string)$departureAttributes['pt']);
                $plannedDepaturePlatform = (string)$departureAttributes['pp'];
                $directionArray = (explode('|', (string)$departureAttributes['ppth']));
                $toDirection = $directionArray[count($directionArray) - 1];

                $event=new TimeTableEvent();
                $event->setType('departure');
                $event->setPlanedPlatform($plannedDepaturePlatform);
                $event->setPlanedTime($planedDeparture);
                $event->setToDirection($toDirection);
                $event->setConnection($connectionModel);
                $this->em->persist($event);

            }
            $this->em->persist($connectionModel);
            $this->em->flush();


        }

    }
}