<?php
namespace App\Models;

require_once "DBAbstractModel.php";

class Comment extends DBAbstractModel
{
    private $id;
    private $user;
    private $comment;
    private $blogId;
    private $created;
    private $approved;
    private $updated;
    private static $instancia;

    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    // Métodos setters
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function setBlog($blogId)
    {
        $this->blogId = $blogId;
    }
    public function setComment($comment)
    {
        $this->comment = $comment;
    }
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }
    public function setCreated($created)
    {
        $this->created = $created;
    }
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    // Métodos getters
    public function getUser()
    {
        return $this->user;
    }
    public function getComment()
    {
        return $this->comment;
    }
    public function getApproved()
    {
        return $this->approved;
    }
    public function getCreated()
    {
        return $this->created;
    }
    public function getUpdated()
    {
        return $this->updated;
    }

    public function set()
    {
        $this->query = "INSERT INTO comment (blog_id, user, comment, approved) 
                        VALUES (:blogId, :user, :comment, :approved)";

        $this->parametros['blogId'] = $this->blogId;
        $this->parametros['user'] = $this->user;
        $this->parametros['comment'] = $this->comment;
        $this->parametros['approved'] = $this->approved;
        $this->get_results_from_query();

        if ($this->created === null) {
            $this->created = new \DateTime();
        }
        if ($this->updated === null) {
            $this->updated = new \DateTime();
        }

        $this->parametros['created'] = $this->created->format('Y-m-d H:i:s');
        $this->parametros['updated'] = $this->updated->format('Y-m-d H:i:s');

        $this->get_results_from_query();
    }



    // Métodos no implementados
    protected function delete()
    {
    }
    protected function edit()
    {
    }
    protected function get()
    {
    }
}
