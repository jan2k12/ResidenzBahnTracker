<?php

require_once __DIR__."/../../vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("/src/rbTracker/entities");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => getenv('mysql_user'),
    'password' => getenv('mysql_pass'),
    'dbname'   => getenv('mysql_dbname'),
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);