<?php
/**
 * 
 * @author Óscar Martín-Castaño
 */
$meses = array(
    "Enero"  => 31,
    "Febrero" => array(28,29),
    "Marzo" => 31,
    "Abril" => 30,
    "Mayo" => 31,
    "Junio" => 30,
    "Julio" => 31,
    "Agosto" => 31,
    "Septiembre" => 30,
    "Octubre" => 31,
    "Noviembre" => 30,
    "Diciembre" => 31,
);

foreach($meses as $clave =>$valor)
{
    if ($clave == 'Febrero'){
        echo "$clave puede tener $valor[0] o $valor[1] días";
        echo "<br/>";
    }
    else {
        echo "$clave tiene $valor días";
    echo "<br/>";
    }
}
 ?>