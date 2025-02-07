<?php
/**
 * Creación de cookie
 * @author Óscar Martín-Castaño
 */

echo "Inicio <br/>";

 //Crear cookie
setcookie("cookie","Hola mundo",time()+60);

if (isset($_COOKIE["cookie"])){
    echo $_COOKIE["cookie"];
}

echo "<br/>";
echo "FIN <br/>";
?>