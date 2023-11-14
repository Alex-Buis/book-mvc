<?php

use M2i\Mvc\App;

require '../vendor/autoload.php';

$app = new App ();
// Ligne utille que si on ne fait pas de "php-S"
// $app->setBasePath('/poo/06-mvc/punblic/');

// Toutes les routes du site 
$app->addRoutes([
    ['GET', '/' , 'HomeController@index'],
    ['GET', '/utilisateurs' , 'UserController@list'],
    ['GET', '/livre/[i:id]' , 'BookController@show'],
    ['GET|POST', '/utilisateurs/creer' ,'UserController@create'],
    ['GET', '/livres' , 'BookController@list'],
    ['GET','/livres/delete/[i:id]' ,'BookController@delete'],
    ['GET','/livre/[i:id]' ,'BookController@show'],

]);

// Lancer l'application
$app->run();