<?php
/**
 * Eliminacion de cookie
 * 
 */

 if (isset($_COOKIE["cookie"])){
    setcookie("cookie", "Hola mundo", time()-60);
    echo "cookie borrada";
 }
?>