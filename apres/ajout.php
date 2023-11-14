<?php
require 'config/database.php';
require 'data.php';

$title = 'Ajouter un livre';

// Récupérer les données
$btitle = $_POST['title'] ?? null;
$price = $_POST['price'] ?? null;
$discount = $_POST['discount'] ?? null;
$isbn = $_POST['isbn'] ?? null;
$author = $_POST['author'] ?? null;
$published_at = $_POST['published_at'] ?? null;
$errors = [];
// Vérifier les données 
if (!empty($_POST)){
    if (empty($btitle)){
        $errors['title'] = 'Le titre est invalide.';
    }

    if($price < 1 || $price > 100) {
        $errors ['price'] = 'le prix est invalide.';
    }

    if (!empty($discount) && ($discount < 0 || $discount > 100)) {
        $errors ['discount'] = ' La promotion est invalide ';
    }

    if (strlen ($isbn) != 10 && strlen ($isbn) != 13 ) {
        $errors ['isbn'] = 'l\' ISBN est invalide';
    }

    if (empty($author)) {
        $errors ['author'] = 'l\' auteur est invalide';
    }

    // Valider une date
    // $publishedAt = '2023-11-06';
    $checked = explode('-', $publishedAt); // [2023-11-06]
    // (int) permet de caster une chaine en entier
    if(!checkdate($checked[1] ?? 0 , $checked[2] ?? 0 , (int)$checked[0])) {
        $errors['published_at'] = 'La date est invalide.';
    }

    if (empty($errors)){
        //@todo faire un insert, rediréction , message session ? 
        insert('INSERT INTO books (title,price,discount,isbn,author,published_at, image)
            VALUES(?,?,?,?,?,?,?)',[
                htmlspecialchars($btitle),
                $price,
                empty($discount) ? null : $discount,
                $isbn,
                htmlspecialchars($author),
                $published_at,
                'uploads/86.jpg',
            ]);
            addMessage('Votre libre a été ajouté !');
            // Redirection
            redirect ('livres.php');
    }
}
// Message dans la session

require 'partials/header.php';
?>
    <div class="max-w-5xl mx-auto px-3">
    <?php if (!empty ($errors)) { ?>
        <div class="bg-red-300 p-5 rounded border border-red-800 text-red-800 my-4">
            <?php foreach ($errors as $error) { ?>
            <p> <?= $error; ?> </p>
            <?php } ?>
        </div>
        <?php } ?>
        <form action="" method="post" class="w-1/2 mx-auto" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="title" class="block">Titre *</label>
                <input type="text" name="title" id="title" class="border-0 border-b focus:ring-0 w-full" value="<?= $btitle; ?>">
            </div>
            <div class="mb-4">
                <label for="price" class="block">Prix *</label>
                <input type="text" name="price" id="price" class="border-0 border-b focus:ring-0 w-full" value="<?= $price; ?>">
            </div>
            <div class="mb-4">
                <label for="discount" class="block">Promotion</label>
                <input type="text" name="discount" id="discount" class="border-0 border-b focus:ring-0 w-full" value="<?= $discount; ?>">
            </div>
            <div class="mb-4">
                <label for="isbn" class="block">ISBN *</label>
                <input type="text" name="isbn" id="isbn" class="border-0 border-b focus:ring-0 w-full" value="<?= $isbn; ?>">
            </div>
            <div class="mb-4">
                <label for="author" class="block">Auteur *</label>
                <input type="text" name="author" id="author" class="border-0 border-b focus:ring-0 w-full" value="<?= $author; ?>">
            </div>
            <div class="mb-4">
                <label for="published_at" class="block">Publié le *</label>
                <input type="date" name="published_at" id="published_at" class="border-0 border-b focus:ring-0 w-full" value="<?= $publishedAt; ?>">
            </div>
            <div class="mb-4">
                <label for="image" class="block mb-2">Image *</label>
                <input type="file" name="image" id="image" class="cursor-pointer w-full
                    file:rounded-full file:border-0 file:cursor-pointer
                    file:bg-blue-50 hover:file:bg-blue-100
                    file:font-semibold file:py-2 file:px-4 file:mr-4
                ">
            </div>

            <div class="text-center">
                <button class="bg-gray-900 px-4 py-2 text-white inline-block rounded hover:bg-gray-700 duration-200">Créer</button>
            </div>
        </form>
    </div>

    <?php require 'partials/footer.php'; ?>
