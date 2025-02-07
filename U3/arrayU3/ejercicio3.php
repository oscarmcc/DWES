<?php
/**
 * Crear un array con los alumnos de clase y permitir la selección aleatoria de uno de
 * ellos. El resultado debe mostrar nombre y fotografía.
 * 
 */
$alumnos = array(
    'Raúl Bermúdez',
    'Carlos Borreguero',
    'Álvaro Cañas',
    'Miguel Carmona',
    'Alejandro Carrasco',
    'Mostafa Cherif',
    'Alejandro Coronado',
    'Juan Diego Delgado',
    'Marlon Jafet Escoto',
    'Ángel Fernández',
    'Alejandro Fernández',
    'Daniel Fernández',
    'Jesús Ferrer',
    'Jesús Frías',
    'Manuel Galán',
    'Víctor García',
    'Lucía García',
    'Adrián González',
    'Jesús López',
    'Enrique Mariño',
    'Óscar Martín-Castaño',
    'José María Mayén',
    'Pablo Mérida',
    'Héctor Mora',
    'Luis Pérez',
    'Carlos Romero',
    'Javier Ruiz',
    'Alejandro Vaquero',
    'Luis Miguel Villén'
);

$fotos = array('invierno.png');
$numero_aleatorio = mt_rand(0, 28);

echo '<h1>Alumno con su foto</h1>';
echo '<h3>Alumno: ' . $alumnos[$numero_aleatorio].'</h3>';
echo '<img src="foto/'. $fotos[0].'" alt= "Imagen del alumno" wdth="500">';
?>