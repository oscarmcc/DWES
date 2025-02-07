<?php
    /**
    * 
    * @author Óscar Martín-Castaño
    */

    // Cargar en un array los dias de la semana
    $diasSemana = array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");
    // Calculamos el tamaño de días
    $numeroDias = count($diasSemana);
    // Recorremos el array
    for($i = 0; $i < $numeroDias; $i++)
    {
        echo $diasSemana[$i];
        echo '<br/>';
    }


?>