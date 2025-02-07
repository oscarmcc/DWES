<?php
/**
 * Contador cuantas veces entra al servidor
 */
 
if (!isset($_COOKIE["contador"])){
    // Crear cookie
    setcookie("contador",0,time()+3600);
}else {
    // Incrementamos la cookie
    $valor = $_COOKIE["contador"]+1;
    setcookie("contador",$valor,time()+3600);
}

// Mostramos la cookie
echo $_COOKIE["contador"];
?>