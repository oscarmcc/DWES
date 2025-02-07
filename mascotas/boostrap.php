<?php require 'vendor/autoload.php';

    use Dotenv\Dotenv;

    $dontenv = Dotenv::createImmutable(__DIR__);
    $dontenv->load();
    define('DBHOST', "localhost");
    define('DBNAME', $_ENV['DBNAME']);
    define('DBUSER', $_ENV['DBUSER']);
    define('DBPASS', $_ENV['DBPASS']);
    define('DBPORT', 3306);
?>