<?php
/**
 * 
 * 
 */

 session_start();
 if (!isset($_SESSION['nombre'])){
    $_SESSION['nombre'] = 'Oscar';
    $_SESSION['apellidos'] = 'Martin-Castaño';
 }