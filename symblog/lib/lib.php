<?php

// Uso del modelo Blog del namespace App\Models
use App\Models\Blog;

// Función para obtener todas las etiquetas únicas de todos los blogs
function getAllTags() {
    $allTags = []; // Array para almacenar todas las etiquetas únicas

    // Iterar sobre todos los blogs
    foreach (Blog::all() as $blog) {
        // Dividir la cadena de etiquetas del blog en un array
        foreach (explode(", ", $blog->tags) as $tag) {
            // Si la etiqueta no está ya en el array, añadirla
            if (!in_array($tag, $allTags)) $allTags[] = $tag;
        }
    }

    return $allTags; // Devolver el array de etiquetas únicas
}

// Función para contar cuántas veces aparece una etiqueta específica en todos los blogs
function countTag($tag) {
    $count = 0; // Inicializar el contador a 0

    // Iterar sobre todos los blogs
    foreach (Blog::all() as $blog) {
        // Si la etiqueta está en el array de etiquetas del blog, incrementar el contador
        if (in_array($tag, explode(", ", $blog->tags)))  $count++;
    }

    return $count; // Devolver el contador
}

// Función para generar una cadena HTML que representa una nube de etiquetas (Tag Cloud)
function printTags() {
    $tags = ""; // Inicializar la cadena de etiquetas vacía

    // Iterar sobre todas las etiquetas únicas
    foreach (getAllTags() as $tag) {
        // Si la etiqueta aparece 5 o más veces, asignar la clase weight-5
        if (countTag($tag) >= 5) {
            $tags .= "<span class=\"weight-5\">".$tag."</span>";
        } else {
            // Si la etiqueta aparece menos de 5 veces, asignar una clase basada en su frecuencia
            $tags .= "<span class=\"weight-".countTag($tag)."\">".$tag."</span>";
        }
    }

    return $tags; // Devolver la cadena de etiquetas
}

// Función para obtener todos los comentarios de una lista de blogs y ordenarlos por fecha
function getAllComments($blogs) {
    $allComments = []; // Array para almacenar todos los comentarios

    // Iterar sobre cada blog en la lista de blogs proporcionada
    foreach ($blogs as $blog) {
        // Iterar sobre cada comentario del blog
        foreach ($blog->comment as $comment) {
            // Añadir el comentario al array con información adicional
            $allComments[] = [
                'comment' => $comment->comment,
                'user' => $comment->user,
                'created' => $comment->created, // Fecha de creación del comentario
                'blogId' => $blog->id,
                'blogTitle' => $blog->title,
            ];
        }
    }

    // Ordenar los comentarios por fecha en orden descendente
    usort($allComments, function ($a, $b) {
        return strtotime($a['created']) - strtotime($b['created']);
    });

    return $allComments; // Devolver el array de comentarios ordenados
}