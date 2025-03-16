<?php

// Declaración del namespace para la organización del código
namespace App\Models;

// Uso de la clase Eloquent del ORM de Laravel
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\Comment;

// Definición de la clase Blog que extiende de Eloquent
class Blog extends Eloquent {
    
    // Nombre de la tabla asociada en la base de datos
    protected $table = "blog";

    // Constantes para los campos de timestamps
    const CREATED_AT = "created";
    const UPDATED_AT = "updated";

    // Campos que se pueden asignar en masa
    protected $fillable = ["id", "title", "author", "blog", "image", "tags", "created", "updated"];

    // Relación uno a muchos con el modelo Comment
    public function comment() {
        return $this->hasMany(Comment::class);
    }

    // Método para obtener los comentarios asociados al blog
    public function getComments() {
        $comments = [];
        foreach (Blog::find($this->id)->comment as $value2) {
            $comments[] = $value2;
        }
        return $comments;
    }

    // Método para obtener el número de comentarios asociados al blog
    public function numComments() {
        return count(Blog::find($this->id)->comment);
    }
}