<?php
session_start();
session_destroy();
header("Location: sesion2.php");
exit();
?>
