<?php

/**
 * Le but de ce script est de remplir la base de données.
 */
require 'data.php';

// Connexion à PDO ici (dans un fichier config/database.php ?)
require 'config/database.php';

// Dans la boucle, on fait une requête préparée pour insérer le livre
// avec ses données ?
$query = $db->prepare('INSERT INTO books (
    title, price, discount, isbn, author, published_at, image
) VALUES (?, ?, ?, ?, ?, ?, ?)');

// Boucles sur les livres
foreach ($books as $book) {
    $query->execute([
        $book['title'],
        $book['price'],
        $book['discount'],
        $book['isbn'],
        $book['author'],
        $book['published_at'],
        $book['image'],
    ]);

    echo 'Ajout de '.$book['title'].'...<br>';
}
