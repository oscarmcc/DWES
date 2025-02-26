<?php 
require 'vendor/autoload.php'; 
use Dotenv\Dotenv;
use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $_ENV['DBHOST'],
    'database'  => $_ENV['DBNAME'],
    'username'  => $_ENV['DBUSER'],
    'password'  => $_ENV['DBPASS'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods
$capsule->setAsGlobal();

// Setup the Eloquent ORM
$capsule->bootEloquent();
?>