<?php
/**
 * 
 * @author oscar <email>
 */
require_once "config.php";
$aleatorio= random_int(0,1);
if ($aleatorio == 0 ){
?>
<form action="procesa1.php" method="post"> 
    <label>¿Cuáles de los siguientes países están en América del Sur? </label>
    <div>
        <input type="checkbox" id="p1respuesta1" name="pregunta1[]" value="a) Brasil">
        <label for="respuesta1">(a) Brasil</label>
    </div>
    <div>
        <input type="checkbox" id="p1respuesta2" name="pregunta1[]" value="b) Mexico">
        <label for="respuesta2">(b) México</label>
    </div>
    <div>
        <input type="checkbox" id="p1respuesta3" name="pregunta1[]" value="c) Argentina">
        <label for="respuesta3">(c) Argentina</label>
    </div>
    <div>
        <input type="checkbox" id="p1respuesta4" name="pregunta1[]" value="d) España">
        <label for="respuesta4">(d) España</label>
    </div>

    <label>¿Cuáles de las siguientes son montañas o sistemas montañosos </label>
    <div>
        <input type="checkbox" id="p2respuesta1" name="pregunta2[]" value="a) Himalaya">
        <label for="respuesta1">(a) Himalaya</label>
    </div>
    <div>
        <input type="checkbox" id="p2respuesta2" name="pregunta2[]" value="b) Amazonas">
        <label for="respuesta2">(b) Amazonas</label>
    </div>
    <div>
        <input type="checkbox" id="p2respuesta3" name="pregunta2[]" value="c) Andes">
        <label for="respuesta3">(c) Andes</label>
    </div>
    <div>
        <input type="checkbox" id="p2respuesta4" name="pregunta2[]" value="d) Rio Nilo">
        <label for="respuesta4">(d) Río Nilo</label>
    </div>

    <label>¿Qué continentes cruzan la línea del Ecuador? </label>
    <div>
        <input type="checkbox" id="p3respuesta1" name="pregunta3[]" value="a) América del Norte">
        <label for="respuesta1">(a) América del Norte</label>
    </div>
    <div>
        <input type="checkbox" id="p3respuesta2" name="pregunta3[]" value="b) África">
        <label for="respuesta2">(b) África</label>
    </div>
    <div>
        <input type="checkbox" id="p3respuesta3" name="pregunta3[]" value="c) Asia">
        <label for="respuesta3">(c) Asia</label>
    </div>
    <div>
        <input type="checkbox" id="p3respuesta4" name="pregunta3[]" value="d) Oceanía">
        <label for="respuesta4">(d) Oceanía</label>
    </div>

    <label>El río Amazonas es el más grande del mundo </label>
    <div>
        <input type="radio" id="p4respuesta1" name="p4" value="Verdadero">
        <label for="respuesta1">Verdadero</label>
    </div>
    <div>
        <input type="radio" id="p4respuesta2" name="p4" value="Falso">
        <label for="respuesta2">Falso</label>
    </div>

    <label>El desierto del Sahara es el más grande del mundo </label>
    <div>
        <input type="radio" id="p5respuesta1" name="p5" value="Verdadero">
        <label for="respuesta1">Verdadero</label>
    </div>
    <div>
        <input type="radio" id="p5respuesta2" name="p5" value="Falso">
        <label for="respuesta2">Falso</label>
    </div>

    <input type="submit" name="enviar" value="enviar"/>
</form>
<?php
}
else{
    ?>
<form action="procesa2.php" method="post">
<label>El desierto del Sahara es el más grande del mundo </label>
    <div>
        <input type="radio" id="p1respuesta1" name="p1" value="Verdadero">
        <label for="respuesta1">Verdadero</label>
    </div>
    <div>
        <input type="radio" id="p1respuesta2" name="p1" value="Falso">
        <label for="respuesta2">Falso</label>
    </div>
<label>Australia es tanto un país como un continente</label>
<div>
        <input type="radio" id="p2respuesta1" name="p2" value="Verdadero">
        <label for="respuesta1">Verdadero</label>
    </div>
    <div>
        <input type="radio" id="p2respuesta2" name="p2" value="Falso">
        <label for="respuesta2">Falso</label>
    </div>

<label>El monte Everest es la montaña más alta del mundo</label>
<div>
        <input type="radio" id="p3respuesta1" name="p3" value="Verdadero">
        <label for="respuesta1">Verdadero</label>
    </div>
    <div>
        <input type="radio" id="p3respuesta2" name="p3" value="Falso">
        <label for="respuesta2">Falso</label>
    </div>

<label>¿Cuál es la capital de Japón?</label>
<div>
    <input type="text" id="p4respuesta" name="p4">
    <label></label>
</div>
<label>¿Cuál es la comunidad autónoma de España que tiene como lengua cooficial el euskera?</label>
<div>
    <input type="text" id="p5respuesta" name="p5">
    <label></label>
</div>

<input type="submit" name="enviar" value="enviar"/>
</form>
    <?php
}
?>