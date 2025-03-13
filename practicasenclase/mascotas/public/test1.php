<?php
require_once "../app/Model/Mascotas.php";
require_once "../app/config/config.php";

// Creamos mascotas sin utilizar el patron de diseño
$mascota1 = new Mascotas();
$mascota2 = new Mascotas();
// Se han creado dos objetos

// Creamos mascotas utilizando el patron de diesño
$mascota3 = Mascotas::getInstancia();
$mascota4 = Mascotas::getInstancia();
// Se ha creado un solo objeto

// $mascota = Mascotas::getInstancia();
// $mascota ->setNombre("Dacota");
// $mascota ->setPeso(20);
// $mascota ->setRaza("San Bernardo");
// $mascota->set();

// $resultado = $mascota3->get(6);
// echo $resultado['nombre'];
// echo "<br>";
// echo $resultado['peso'];
// echo "<br>";
// echo $resultado['raza'];
// echo "<br>";

$mascota = Mascotas::getInstancia();
$mascota->get(6);
// $mascota->setNombre("Juan");
// $mascota->edit();
// $mascota->delete();
$mascota->delete(6);
var_dump($mascota);
?>