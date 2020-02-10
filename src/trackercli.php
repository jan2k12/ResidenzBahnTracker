<?php
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/app/bootstrap.php';
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new RbTracker\Commands\GetDataFromLastHourCommand());

$application->run();
