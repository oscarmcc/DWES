<?php
namespace App\Models;
use App\Models\Comment;
use Exception;

require_once 'DBAbstractModel.php';

class Blog extends DBAbstractModel {
    private static $instance;
    private $id;
    private $title;
    private $blog;
    private $image;
    private $author;
    private $tags;
    private $created;
    private $updated;
    private $comments = array();

    public function setId($id)
    {
        $this->id = $id;
    }
    public function addComment($comment)
    {
        $this->comments[] = $comment;
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

    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBlog()
    {
        return $this->blog;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Blog();
        }
        return self::$instance;
    }

    public function get($id = '')
    {
    }

    public function set()
    {
        $this->query = "INSERT INTO blog (title, blog, image, author, tags) VALUES (:title, :blog, :image, :author, :tags)";
        $this->parametros['title'] = $this->title;
        $this->parametros['blog'] = $this->blog;
        $this->parametros['image'] = $this->image;
        $this->parametros['author'] = $this->author;
        $this->parametros['tags'] = $this->tags;

        try{
            $this->get_results_from_query();
            // Se debe ejecutar sobre la misma conexión
            $idBlog = $this->lastInsert();
            foreach($this->comments as $comment){
                $this->query = "INSERT INTO comment (comment, blog_id, user, approved) VALUES (:comment, :blog_id, :user, :approved)";
                $this->parametros['blog_id'] = $idBlog;
                $this->parametros['comment'] = $comment->getComment();
                $this->parametros['user'] = $comment->getUser();
                $this->parametros['approved'] = $comment->getApproved();
                $this->get_results_from_query();
            }
            $this->mensaje = 'Post agregado exitosamente';
        }
        catch(Exception $e){
            $this->mensaje = 'Error '. $e->getMessage();
        }
    }

    public function edit($id = '')
    {}

    public function delete($id = '')
    {}

}
?>