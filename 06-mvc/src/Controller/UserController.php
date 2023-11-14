<?php

namespace M2i\Mvc\Controller;

use M2i\Mvc\View;
use M2i\Mvc\Model\User;

class UserController
{
    public function list()
    {
        $name = 'Fiorella';
        $users = User::all();

        return View::render('list', [
            'name' => $name,
            'cars' => ['Pegeaud', 'Sytroend', 'Renod'],
            'users' => $users,
        ]);
    }
    
    public function show ($id)
    {
        $user = User::find($id);
        if (!$user) {
            http_response_code(404);
            return View::render('404');
        }
        return View::render('show', [
            'user'=> $user,
            ]);
        }
            public function create()
            {
                $user = new User();
                $user->name = $_POST['name'] ?? null;
                $errors = [];

                if ( ! empty($_POST)){
                    if(empty($user->name)){
                    $errors['name'] = 'le nom est invalide.';
                    }
                    
                    if(empty($errors)){
                        $user->save(['name']);

                        
                        // View:: rediret ('/utilisateurs')
                    }
                }


                return View::render('create',[
                    'errors' => $errors,
                    'user' => $user,
            ]);
            }
    }

