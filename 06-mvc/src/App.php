<?php

namespace M2i\Mvc;

use AltoRouter;

class App extends AltoRouter
{
    public function run()
    {
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();

    // Permet de récupérer l'URL actuelle
    $match = $this->match();

    //lance le contrôleur
    if (is_array($match)) {
        [$controller, $method ] = explode("@", $match['target']); // UserController@list
        $controller = 'M2i\Mvc\Controller\\'.$controller;
        $object = new $controller();
        $object->$method(... $match['params']);
        } else {
            http_response_code(404);
            View::render('404');
            }   
    }
}