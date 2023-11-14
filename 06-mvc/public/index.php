<?php

use M2i\Mvc\App;
use M2i\Mvc\Controller\MoviesController;

require '../vendor/autoload.php';

$app = new App ();
// Ligne utille que si on ne fait pas de "php-S"
// $app->setBasePath('/poo/06-mvc/punblic/');

// Toutes les routes du site 
$app->addRoutes([
    ['GET', '/' , 'HomeController@index'],
    ['GET', '/utilisateurs' , 'UserController@list'],
    ['GET', '/utilisateurs/[i:id]' , 'UserController@show'],
    ['GET|POST', '/utilisateurs/creer' ,'UserController@create'],
    ['GET', '/films' , 'MoviesController@movies'],

]);

// Lancer l'application
$app->run();