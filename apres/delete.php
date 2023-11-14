<?php

require 'config/database.php';
require 'config/functions.php';

session_start(); //rappel de session start puisque pas de header ici.

//recup l'id qui est à supprimer
$id = $_GET['id'] ?? null;
// $id = (int) $id; //forcer l'id à être un entier (caster) pour evtier une faille modifiée dans l'url.

//faire la requête
$query = $db->prepare('DELETE FROM books WHERE id = :id');
$query->execute(['id' => ($id)]);

//avant redirection, on ajoute un message dans la session (qu'on affiche plus tard).
addMessage('Le livre ' .$btitle. ' a bien été supprimé.');

//redirection vers une page
redirect('/livres');
?>