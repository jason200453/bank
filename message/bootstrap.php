<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "/home/parson_chen/parson_chen/message/autoload.php";

$isDevMode = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, null, null, false);

$conn = array(
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'dbname'   => 'message',
    'user'     => 'root',
    'password' => '1234'
);

$em = EntityManager::create($conn, $config);
