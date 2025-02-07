<?php
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

require_once __DIR__ . '/../../vendor/autoload.php';

// Configuración del transporte (cambia esto según tu servidor SMTP)
$dsn = 'smtp://your_username:your_password@smtp.gmail.com:587';
$transport = Transport::fromDsn($dsn);
$mailer = new Mailer($transport);

return $mailer;
?>