<?php

// Declaración del namespace para la organización del código
namespace App\Controllers;

// Inclusión de una biblioteca externa
include "../lib/lib.php";

// Uso de clases necesarias para la respuesta HTTP y los modelos Blog y Usuario
use App\Controllers\BaseController;
use Laminas\Diactoros\Response\RedirectResponse;
use App\Models\Blog;
use App\Models\Usuario;

// Definición de la clase UserController que extiende de BaseController
class UserController extends BaseController {

    // Método que maneja la acción de agregar un nuevo usuario
    public function AddAction($request) {
        // Obtención de los datos enviados en el cuerpo de la solicitud HTTP
        $postData = $request->getParsedBody();

        // Creación y guardado del usuario en la base de datos
        Usuario::create([
            "user" => $postData["user"],
            'password' => $postData['passwd'],
            'email' => $postData['email']
        ]);

        // Redireccionar a una página diferente después de agregar el usuario
        $cookie = setcookie("newUser", true, time() + 60, "/");

        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();

        // Renderización de la vista "addUser_view.twig" con los datos obtenidos
        return $this->renderHTML("addUser_view.twig", [
            "allComments" => $data["allComments"],
            "tags" => $data["tags"],
            "cookie" => $cookie
        ]);
    }

    // Método que maneja la acción de mostrar el formulario para agregar un nuevo usuario
    public function NewAction() {
        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();

        // Renderización de la vista "addUser_view.twig" con los datos obtenidos
        return $this->renderHTML("addUser_view.twig", [
            "allComments" => $data["allComments"],
            "tags" => $data["tags"]
        ]);
    }
}