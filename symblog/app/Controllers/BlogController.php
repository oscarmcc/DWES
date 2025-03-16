<?php

// Declaración del namespace para la organización del código
namespace App\Controllers;

// Inclusión de una biblioteca externa
include "../lib/lib.php";

// Uso de clases necesarias para la respuesta HTTP y los modelos Blog y Comment
use App\Controllers\BaseController;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Response\HTMLResponse;
use App\Models\Blog;
use App\Models\Comment;
use Respect\Validation\Validator as v;

// Definición de la clase BlogController que extiende de BaseController
class BlogController extends BaseController {

    // Método que maneja la acción de agregar un nuevo blog
    public function AddAction($request) {
        $responseMessage = null;

        // Obtención de los datos enviados en el cuerpo de la solicitud HTTP
        $postData = $request->getParsedBody();
        $blogValidator = v::key('title', v::stringType()->notEmpty())
            ->key('desc', v::stringType()->notEmpty())
            ->key('tags', v::stringType()->notEmpty())
            ->key('author', v::stringType()->notEmpty());

        try {
            // Validación de los datos del blog
            $blogValidator->assert($postData);
            $blogData = [
                'title' => $postData['title'],
                'author' => $postData['author'],
                'blog' => $postData['desc'],
                'tags' => $postData['tags'],
                'image' => null // Valor predeterminado para el campo 'image'
            ];

            // Carga de ficheros
            $files = $request->getUploadedFiles();
            $imagen = $files['image'];
            if ($imagen->getError() == UPLOAD_ERR_OK) {
                $fileName = $imagen->getClientFilename();
                $fileName = uniqid() . $fileName;
                $imagen->moveTO("../public/img/$fileName");
                $blogData['image'] = $fileName;
            }

            // Creación y guardado del blog en la base de datos
            $blog = Blog::create($blogData);
            $blog->save();
            $responseMessage = "Saved";
        } catch (\Exception $e) {
            $responseMessage = $e->getMessage();
        }

        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();
        // Verificación del perfil del usuario en la sesión
        $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

        // Redireccionar a una página diferente después de agregar el blog
        $cookie = setcookie("newBlog", true, time() + 60, "/");

        // Renderización de la vista "addBlog_view.twig" con los datos obtenidos
        return $this->renderHTML("addBlog_view.twig", [
            "allComments" => $data["allComments"],
            "tags" => $data["tags"],
            "profile" => $profile,
            "cookie" => $cookie,
            "responseMessage" => $responseMessage
        ]);
    }

    // Método que maneja la acción de mostrar el formulario para agregar un nuevo blog
    public function NewAction() {
        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();
        // Verificación del perfil del usuario en la sesión
        $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

        // Renderización de la vista "addBlog_view.twig" con los datos obtenidos
        return $this->renderHTML("addBlog_view.twig", [
            "allComments" => $data["allComments"],
            "tags" => $data["tags"],
            "profile" => $profile
        ]);
    }

    // Método que maneja la acción de agregar un comentario a un blog
    public function AddCommentAction($request) {
        $responseMessage = null;

        // Obtención de los datos enviados en el cuerpo de la solicitud HTTP
        $postData = $request->getParsedBody();
        $commentValidator = v::key('comment', v::stringType()->notEmpty());

        try {
            // Validación de los datos del comentario
            $commentValidator->assert($postData);
            // Creación y guardado del comentario en la base de datos
            $comment = Comment::create([
                'blog_id' => $_GET["id"],
                'user' => $_SESSION['user']->user,
                'comment' => $postData['comment'],
                'approved' => 1
            ]);
            $responseMessage = "Saved";
            $comment->save();
        } catch (\Exception $e) {
            $responseMessage = $e->getMessage();
        }

        // Redireccionar a la página del blog después de agregar el comentario
        return new RedirectResponse("/show?id=".$_GET["id"]."");
    }

    // Método que maneja la acción de mostrar un blog
    public function ShowAction($request) {
        // Obtención del blog por su ID
        $data["blog"] = Blog::find($_GET["id"]);
        // Obtención de los últimos 5 comentarios de todos los blogs, ordenados de manera inversa
        $data["allComments"] = array_reverse(array_slice(getAllComments(Blog::all()), -5));
        // Obtención de las etiquetas de los blogs
        $data["tags"] = printTags();

        // Verificación del perfil del usuario en la sesión
        $user = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->user : "Invitado";
        $email = ($_SESSION["user"] !== "Invitado") ? $_SESSION["user"]->email : "Invitado";
        $profile = ($_SESSION["profile"] !== "Invitado") ? $_SESSION["user"]->profile : "Invitado";

        // Renderización de la vista "show_view.twig" con los datos obtenidos
        return $this->renderHTML("show_view.twig", [
            "blog" => $data["blog"],
            "allComments" => $data["allComments"],
            "tags" => $data["tags"],
            "comments" => array_reverse($data["blog"]->getComments()),
            "numComments" => count($data["blog"]->getComments()),
            "profile" => $profile,
            "user" => $user,
            "email" => $email
        ]);
    }
}