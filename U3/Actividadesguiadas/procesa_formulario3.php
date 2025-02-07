<?php
echo $_POST['nombre'] . '</br>';
echo $_POST['apellidos'] . '</br>';
$email= $_POST['email'];

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo "El correo introducido no es válido";
}
else{
    echo $email . '</br>';
}
?>