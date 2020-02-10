<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(__DIR__ . '/../../.env');

$paths = array(__DIR__ . "/../rbTracker/entities/");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => $_ENV['mysql_user'],
    'password' => $_ENV['mysql_pass'],
    'dbname' => $_ENV['mysql_dbname'],
    'host' => $_ENV['mysql_host'],
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);