<?php


namespace RbTracker\Commands;


use RbTracker\Parser\ConnectionSaver;
use RbTracker\Requests\LastHourAllStationsRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetDataFromLastHourCommand extends Command
{
    protected static $defaultName="rbTracker:getLastHour";

    /**
     * GetDataFromLastHourCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }


    protected function configure()
    {
       $this->setDescription('Requestes the Trains from all Stations for the last Hour');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Starting Request");
        $connectionResultXml=(new LastHourAllStationsRequest())->getRequestResult();
        $output->writeln('Got Data - now save connections');
        (new ConnectionSaver($connectionResultXml))->parseAndSaveFromXml();
       /* $changesXml=(new LastHourAllStationsChangesRequest())->getRequestResult();
        (new ChangeSaver($changesXml))->parseAndSaveFromXml();*/


        return 0;



    }


}