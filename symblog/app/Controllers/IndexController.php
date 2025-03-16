<?php

// Declaración del namespace para la organización del código
namespace App\Controllers;

// Inclusión de una biblioteca externa
include "../lib/lib.php";

// Uso de clases necesarias para la respuesta HTTP y el modelo Blog
use App\Controllers\BaseController;
use App\Models\Blog;

// Definición de la clase IndexController que extiende de BaseController
class IndexController extends BaseController {

    // Método que maneja la acción de mostrar la página principal
    public function IndexAction() {
        // Obtención de todos los blogs ordenados por fecha de creación en orden descendente
        $data["blogs"] = Blog::orderBy('created', 'desc')->get();

        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments($data["blogs"]), -5));

        // Verificación del perfil del usuario en la sesión
        $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
        $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";
        $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();

        // Renderización de la vista "index_view.twig" con los datos obtenidos
        return $this->renderHTML("index_view.twig", [
            "blogs" => $data["blogs"],
            "allComments" => $data["allComments"],
            "tags" => $data["tags"],
            "profile" => $profile,
            "user" => $user,
            "email" => $email
        ]);
    }

    // Método que maneja la acción de mostrar la página "About"
    public function AboutAction() {
        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();

        // Verificación del perfil del usuario en la sesión
        $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
        $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";
        $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

        // Renderización de la vista "about_view.twig" con los datos obtenidos
        return $this->renderHTML("about_view.twig", [
            "allComments" => $data["allComments"],
            "tags" => $data["tags"],
            "profile" => $profile,
            "user" => $user,
            "email" => $email
        ]);
    }

    // Método que maneja la acción de mostrar la página "Contact"
    public function ContactAction() {
        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();

        // Verificación del perfil del usuario en la sesión
        $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
        $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";
        $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

        // Renderización de la vista "contact_view.twig" con los datos obtenidos
        return $this->renderHTML("contact_view.twig", [
            "allComments" => $data["allComments"],
            "tags" => $data["tags"],
            "profile" => $profile,
            "user" => $user,
            "email" => $email
        ]);
    }
}