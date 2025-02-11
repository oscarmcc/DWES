<?php require 'vendor/autoload.php';

    use Dotenv\Dotenv;

    $dontenv = Dotenv::createImmutable(__DIR__);
    $dontenv->load();
    define('DBHOST', "localhost");
    define('DBNAME', $_ENV['DBNAME']);
    define('DBUSER', $_ENV['DBUSER']);
    define('DBPASS', $_ENV['DBPASS']);
    define('DBPORT', 3306);
    define('BASE_URL', "http://www.oscar.local");
    // define("SMTP_SERVER", $_ENV['SMTP_SERVER']);
    // Directorio para la subida de los archivos
define("DIRUPLOAD",'/public/upload/');

// Tamaño máximo de los archivos
define("MAXSIZE", 200000);
?>