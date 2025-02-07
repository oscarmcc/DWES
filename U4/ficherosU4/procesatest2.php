<?php
include './config.php';
 if (!isset($_POST['enviar'])) {
    header("Location: test2.php");
 }
//Obtenemos la extension, podriamos hacerlo tambien con pathinfo() más adelante
 $temp = explode(".", $_FILES["file"]["name"]); // ["file"] es el nombre del input
 $extension = end($temp);

 if(($_FILES["file"]["size"] < MAXSIZE  && in_array($_FILES["file"]["type"], $allowedFormat) && in_array($extension, $allowedExts))){
    if($_FILES["file"]["error"] > 0){
        echo "Return Code: " . $_FILES["file"]["error"] . "<br/>";
    }else {
        $filename = $_FILES["file"]["name"];

        // Codificamos el nombre del ficheor en el servidor
        $filename = uniqid().'.'.pathinfo($filename,PATHINFO_EXTENSION);
        if(file_exists(DIRUPLOAD .$filename)){
            echo $_FILES["file"]["name"] . " already exists. ";
        }else{
            move_uploaded_file($_FILES["file"]["tmp_name"], DIRUPLOAD .$filename);
        }
        echo '<a href="javascript:history.back()">Volver</a>';
    }
 }
 
    $grupo = $_POST["grupo"];
    $curso = $_POST["curso"];
    $formato = $_POST["formato"];

    echo "<h2>Datos recibidos:</h2>";
    echo "Grupo: " . htmlspecialchars($grupo) . "<br>";
    echo "Curso: " . htmlspecialchars($curso) . "<br>";
    echo "Formato: " . htmlspecialchars($formato) . "<br>";

?>