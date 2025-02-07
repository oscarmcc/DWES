<?php
// Control de acceso al formulario
if (!isset($_POST["enviar"])){
    header("location:form.php");
}

echo "datos del formulario <br/>";


foreach($_POST as $clave => $valor) {
    if ($clave == "email" && !filter_var($valor, FILTER_VALIDATE_EMAIL)) {
        echo "El formato introducido no es correcto.";
    }
    echo "$valor <br/>";
}
?>