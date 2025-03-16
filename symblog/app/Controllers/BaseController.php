<?php

// Declaración del namespace para la organización del código
namespace App\Controllers;

// Uso de la clase HTMLResponse de la biblioteca Laminas\Diactoros
use Laminas\Diactoros\Response\HtmlResponse;

// Definición de la clase BaseController
class BaseController {

    // Propiedad protegida para el motor de plantillas
    protected $templateEngine;

    // Constructor de la clase
    public function __construct() {
        // Cargador de archivos de plantillas de Twig, especificando el directorio de vistas
        $loader = new \Twig\Loader\FilesystemLoader("../views");
        
        // Inicialización del motor de plantillas Twig con opciones de depuración y sin caché
        $this->templateEngine = new \Twig\Environment($loader, [
            "debug" => true, // Habilita el modo de depuración
            "cache" => false // Deshabilita la caché para el desarrollo
        ]);
    }

    // Método para renderizar una plantilla HTML
    public function renderHTML($fileName, $data = []) {
        // Renderiza la plantilla especificada con los datos proporcionados y devuelve una respuesta HTML
        return new HTMLResponse($this->templateEngine->render($fileName, $data));
    }
}
?>