<?php

// Declaración del namespace para la organización del código
namespace App\Models;

// Uso de la clase Eloquent del ORM de Laravel
use Illuminate\Database\Eloquent\Model as Eloquent;

// Definición de la clase Comment que extiende de Eloquent
class Comment extends Eloquent {
    
    // Nombre de la tabla asociada en la base de datos
    protected $table = "comment";

    // Constantes para los campos de timestamps
    const CREATED_AT = "created";
    const UPDATED_AT = "updated";

    // Campos que se pueden asignar en masa
    protected $fillable = ["id", "blog_id", "user", "comment", "approved", "created", "updated"];
}