<?php
/**
 * 
 * 
 */

 // Requerimos clase Persona
 require_once "Persona.php";
 require_once "Alumno.php";

 // Creamos un objeto
 $persona = new Persona("Óscar", "Martín-Castaño", "Carrillo");
 
 $persona->Saludo();

 echo "<br/>";

 echo $persona->nombre();

 echo "<br/>";

 $alumno = new Alumno("Óscar", "Martín-Castaño", "Carrillo");
 $alumno->Saludo();
?>