<?php
namespace App\Models;

use Exception;

require_once 'DBAbstractModel.php';

class Comment extends DBAbstractModel {
    private static $instance;
    private $id;
    private $comment;
    private $created;
    private $updated;
    private $blog_id;
    private $user;
    private $approved;

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    public function setBlogId($blog_id)
    {
        $this->blog_id = $blog_id;
    }

    public function setUser($user_id)
    {
        $this->user = $user_id;
    }

    public function setApproved($approved)
    {
        $this->approved = $approved;
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Comment();
        }
        return self::$instance;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getComment()
    {
        return $this->comment;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getBlogId()
    {
        return $this->blog_id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getApproved()
    {
        return $this->approved;
    }

    public function set(){
        $fecha = new \DateTime();
        $this->query = "INSERT INTO comments (comment, created, updated, blog_id, user_id, approved) VALUES (:comment, :created, :updated, :blog_id, :user_id, :approved)";
        $this->parametros['comment'] = $this->comment;
        $this->parametros['blog_id'] = $this->blog_id;
        $this->parametros['user'] = $this->user;
        $this->parametros['approved'] = $this->approved;
        try{
            $this->get_results_from_query();
            $id= $this->lastInsert();
            foreach($this->comment as $comment){
                $comment->setId($id);
            }
            $this->mensaje = 'Comentario agregado exitosamente';
        }catch(Exception $e){
            $this->mensaje = 'Error ' . $e->getMessage();
        }
    }
    
    public function get($id = ''){
    }

    public function edit($id = ''){
    }

    public function delete($id = ''){
    }
}
?>