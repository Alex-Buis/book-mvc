<?php 

namespace M2i\Mvc\Model;

class Book extends Model
{
    public $id;
    public $name;
    public $price;
    public $btitle;
    public $discount;
    public $isbn;
    public $author;
    public $publishedAt;
    public $errors = [];
}