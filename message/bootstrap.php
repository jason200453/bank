<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "/home/parson_chen/test/doctrine2-tutorial/vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, null, null, false);
// or if you prefer yaml or XML
//$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/config/xml"), $isDevMode);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
//$conn = array(
//    'driver' => 'pdo_sqlite',
//    'path' => __DIR__ . '/db.sqlite',
//);
$conn = array(
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'dbname'   => 'message',
    'user'     => 'root',
    'password' => '1234'
);

// obtaining the entity manager
$em = EntityManager::create($conn, $config);

