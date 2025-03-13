<?php
namespace App\Models;

use App\Models\Comment;
require_once "DBAbstractModel.php";

class Blog extends DBAbstractModel
{
    private $id;
    private $title;
    private $author;
    private $blog;
    private $image;
    private $tags;
    private $created;
    private $updated;
    private $comments = [];
    private static $instancia;

    // Métodos setters
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setBlog($blog)
    {
        $this->blog = $blog;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    public function setCreated($created)
    {
        $this->created = $created;
    }
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }
    public function getId()
    {
        return $this->id;
    }

    public function addComment($comment)
    {
        $this->comments[] = $comment;
    }

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function set()
    {
        $this->query = "INSERT INTO blog (title, author, blog, image, tags) VALUES (:title, :author, :blog, :image, :tags)";
        $this->parametros['title'] = $this->title;
        $this->parametros['blog'] = $this->blog;
        $this->parametros['image'] = $this->image;
        $this->parametros['author'] = $this->author;
        $this->parametros['tags'] = $this->tags;

        try {
            $this->get_results_from_query();

            // Se debe ejecutar sobre la misma conexión.
            $idBlog = $this->lastInsert();

            foreach ($this->comments as $comment) {
                $this->query = "INSERT INTO comment (blog_id, user, comment, approved) 
                                VALUES (:blog_id, :user, :comment, :approved)";
                $this->parametros['blog_id'] = $idBlog;
                $this->parametros['user'] = $comment->getUser();
                $this->parametros['comment'] = $comment->getComment();
                $this->parametros['approved'] = $comment->getApproved();
                $this->get_results_from_query();
            }
            $this->mensaje = 'Añadido';
        } catch (\Exception $e) {
            $this->mensaje = 'Error al añadir: ' . $e->getMessage();
        }
    }
    public function delete()
    {
    }
    public function edit()
    {
    }
    public function get()
    {
    }
}