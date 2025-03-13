<?php
    require_once 'vendor/autoload.php';
    use Dotenv\Dotenv;
    use Illuminate\Database\Capsule\Manager as Capsule;
    session_start();
    if (!isset($_SESSION['perfil'])){
        $_SESSION['perfil'] = 'invitado';
        $_SESSION['user'] = null;
    }

    $dontenv = Dotenv::createImmutable(__DIR__)->load();

    $capsule = new Capsule;
    $capsule->addConnection([
        "driver" => "mysql",
        "host" => $_ENV['DBHOST'],
        "username" => $_ENV['DBUSER'],
        "password" => $_ENV['DBPASS'],
        "database" => $_ENV['DBNAME'],
        "port" => $_ENV['DBPORT']
    ]);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();