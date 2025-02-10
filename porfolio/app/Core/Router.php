<?php

namespace App\Core;
class Router
{
    private $routes = array(); // array de rutas
    public function add($route) // añadimos la ruta al array
    {
        $this->routes[] = $route;
    }
    public function match(string $request, string $userRole) // recibe un string $request y el rol del usuario
    {
        foreach ($this->routes as $route) {
            $patron = $route['path']; // saca el path de la ruta
            if (preg_match($patron, $request)) { // compara con expresiones regulares el patrón con la entrada
                if (in_array($userRole, $route['roles'])) { // verifica si el rol del usuario está permitido para esta ruta
                    return $route;
                }
            }
        }
        return null; // si no hay coincidencia, devuelve null
    }
}