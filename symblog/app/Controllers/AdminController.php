<?php
// adddddddd
// Declaración del namespace para la organización del código
namespace App\Controllers;

// Inclusión de una biblioteca externa
include "../lib/lib.php";

// Uso de clases necesarias para la respuesta HTTP y el modelo Blog
use Laminas\Diactoros\Response\HTMLResponse;
use App\Models\Blog;

// Definición de la clase AdminController que extiende de BaseController
class AdminController extends BaseController {

    // Método que maneja la acción de administración
    public function AdminAction() {

        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));

        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();

        // Verificación del perfil del usuario en la sesión
        // Si el usuario no es "Invitado", se obtiene el nombre de usuario y el correo electrónico
        // Si el usuario es "Invitado", se asigna "Invitado" a las variables $user y $email
        $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
        $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";

        // Renderización de la vista "admin_view.twig" con los datos obtenidos
        return $this->renderHTML("admin_view.twig", [
            "allComments" => $data["allComments"], // Últimos 5 comentarios
            "tags" => $data["tags"], // Etiquetas de los blogs
            "user" => $user, // Nombre de usuario
            "email" => $email // Correo electrónico del usuario
        ]);
    }
}