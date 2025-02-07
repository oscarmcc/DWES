<?php

$formulario = array(
    'nombre',
    'apellidos',
    'email',
);

echo '<form action="procesa_formulario3.php" method="post">';
for($contador = 0; $contador < count($formulario); $contador++){
    echo '<input type="text" name="' . $formulario[$contador] . '" placeholder="' . $formulario[$contador] . '" value=""/>';
}
echo '<input type="submit" name="enviar" value="send"/>';
echo '</form>';
?>