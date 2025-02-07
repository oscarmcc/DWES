<?php
/**
 * Probamos la clase Contador
 * @author oscar <email>
 */

 // Requerimos el contador
 require_once "Contador.php";

// Obtenemos el numero de instancias
 $nInstancias = Contador::ninstancias();
 echo $nInstancias;
 echo "<br/>";

 // Creamos varios contadores
 $contador1 = new Contador();
 $contador2 = new Contador(100);
 $contador3 = new Contador();

 // Mostramos el valor de los contadores
 echo $contador1 . "<br/>";
 echo $contador2 . "<br/>";

 $contador1->contar();
 $contador1->contar();

 $contador2->contar();
 $contador2->contar();

 // Mostramos los valores del contador despues de incrementar
 echo $contador1 . "<br/>";
 echo $contador2 . "<br/>";

 // Comprobamos el numero de instancias creadas
 $nInstancias = Contador::ninstancias();
 echo $nInstancias;
?>