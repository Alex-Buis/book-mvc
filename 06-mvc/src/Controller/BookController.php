<?php

namespace M2i\Mvc\Controller;

use M2i\Mvc\Database;
use M2i\Mvc\Model\Book;
use M2i\Mvc\View;
use M2i\Mvc\Model\User;


class BookController
{

public function list()
    {

        $books = (Book::all());
        return View::render('livres', ['books' => $books,
    ]);

    }
        public function show($id) 
        {

            if (!$books = Book::find($id)) {
                http_response_code(404);
                return View::render('404');
            }

        return View::render('livre', [
            'title' => $books['title'],
            'price' => $books['price'],
            'isbn' => $books['isbn'],
            'author' => $books['author'],
            'publishedAt' => $books['publishedAt'],
            'image' => $books['image'],
            'discount' => $books['discount'],
        ]);
        }
        public function delete(int $id)
        {
            $query = Database::get()->prepare('DELETE FROM books WHERE id = :id');
            $query->execute(['id' => ($id)]);
            header('location:/livres');
        }
        //insert
    public function ajout()
    {

    $book = new Book();
    

    $book->title = $_POST['title'] ?? null;
    $book->price = $_POST['price'] ?? null;
    $book->discount = $_POST['discount'] ?? null;
    $book->isbn = $_POST['isbn'] ?? null;
    $book->author = $_POST['author'] ?? null;
    $book->publishedAt = $_POST['publishedAt'] ?? null;
    $book->image = 'uploads/01.jpg';
    $errors =[];

    if(!empty($_POST)) { //formulaire non vide
        if(empty($book->title)) {
            $errors['title']= 'Le titre est obligatoire.';
        }
        if($book->price<1 || $book->price>100) {
            $errors['price']= 'Le prix est obligatoire et doit etre compris entre 1 et 100€.';
        }
        if(!empty($book->discount) && ($book->discount>100 || $book->discount<0)) {
            $errors['discount']= 'La promotion doit etre comprise entre 0 et 100%.';
        }
        if(strlen($book->isbn) !=13 && strlen($book->isbn) !=10) {
            $errors['isbn']= 'L\'ISBN est invalide, il doit contenir 10 ou 13 chiffres.';
        }
        if(empty($book->author)) {
            $errors['author']= 'Veuillez entrer le nom de l\'auteur.';
        }
        $checked = explode('-', $book->publishedAt); 
        if(!checkdate($checked[1] ?? 0, $checked[2] ?? 0, (int)$checked[0])) { 
            $errors['publishedAt'] = 'La date est invalide.';
        }
        
        if(empty($errors)){ 

            $book->save(['title','price', 'discount', 'isbn', 'author', 'publishedAt','image']);

        }
    }
    
        return View::render('ajout', [
                'title' => $book->title,
                'price' => $book->price,
                'isbn' => $book->isbn,
                'author' => $book->author,
                'publishedAt' => $book->publishedAt,
                'image' => $book->image,
                'discount' => $book->discount,
                'errors' => $errors,
        ]);
        //message "le livre a bien été ajouté" ou redirection
        header('location: /livres');
    }

    public function edit()
    {

        $book = new Book();
        
        $book->title = $_POST['title'] ?? null;
        $book->price = $_POST['price'] ?? null;
        $book->discount = $_POST['discount'] ?? null;
        $book->isbn = $_POST['isbn'] ?? null;
        $book->author = $_POST['author'] ?? null;
        $book->publishedAt = $_POST['publishedAt'] ?? null;
        $book->image = 'uploads/01.jpg';
        $errors =[];
    }

}