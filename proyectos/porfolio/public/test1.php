<?php
require_once "../app/config/config.php";
use \App\Model\Users;

// Creamos el usuario utilizando el patrón de diseño
$usuario1 = Users::getInstancia();

$usuario1->setRegistro("Óscar", "Martín-Castaño", "foto", "DAW Juvenil", "2005omcc@gmail.com", "Estudiante de Desarrollo de Aplicaciones Web", "oscar");

// $resultado = $usuario1->get(1);
// echo $resultado['nombre'];
// echo "<br>";
// echo $resultado['apellidos'];
// echo "<br>";
// echo $resultado['foto'];
// echo "<br>";
// echo $resultado['categoria_profesional'];
// echo "<br>";
// echo $resultado['email'];
// echo "<br>";
// echo $resultado['resumen_perfil'];
// echo "<br>";
// echo $resultado['passwd'];
// echo "<br>";
// echo $resultado['token'];
// echo "<br>";
// echo $resultado['fecha_creacion_token'];
// echo "<br>";
// echo $resultado['cuenta_activa'];
// echo "<br>";

// $usuario1->get(1);
// $usuario1->setNombre("Pilar");
// $usuario1->edit();
// $usuario1->delete(1);
// var_dump($usuario1);
?>