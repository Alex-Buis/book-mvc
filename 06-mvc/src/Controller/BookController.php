<?php

namespace M2i\Mvc\Controller;

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

            if ($books = Book::find($id)) {
                http_response_code(404);
                return View::render('404');
            }

        return View::render('livre', [
            'title' => $books['title'],
            'price' => $books['price'],
            'isbn' => $books['isbn'],
            'author' => $books['author'],
            'publishedAt' => $books['published_at'],
            'image' => $books['image'],
        ]);
        }
}