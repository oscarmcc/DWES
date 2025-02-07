<?php

/**
 * Subida de un archivo al servidor.
 *
 * Script respuesta al formulario de carga de archivo al servidor.
 * @author dwes
 *
 **/

 define("DIRUPLOAD", 'upload/');
 define("MAXSIZE", 200000);
 $allowedExts = array("gif", "jpeg", "jpg", "png");
 $allowedFormat = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/x-png");
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
     if (($_FILES["file"]["size"] < MAXSIZE) &&
         in_array($_FILES["file"]["type"], $allowedFormat) &&
         in_array($extension, $allowedExts)
     ) {
         if ($_FILES["file"]["error"] > 0) {
             echo "Return Code: " . $_FILES["file"]["error"] . "<br/>";
         } else {
             $filename = uniqid() . '.' . $extension;
             if (!file_exists(DIRUPLOAD)) {
                 mkdir(DIRUPLOAD, 0777, true);
             }
             move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD . $filename);
             echo "Stored in: " . DIRUPLOAD . $filename . "<br/>";
         }
     } else {
         echo "Archivo inválido: el tipo MIME es " . $_FILES["file"]["type"] . " y la extensión es " . $extension;
     }
 }
 ?>