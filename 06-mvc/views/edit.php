<?php
    $title = 'Modifier un livre';
    require 'config/database.php';
    require 'config/functions.php';

    // Récupérer le livre à modifier
    $id = $_GET['id'] ?? null;
    //$query = $db->prepare('SELECT * FROM books WHERE id = :modif');
    //$query->execute(['modif' => $id]);
    //$contact = $query->fetch();
    $bookUpd = ($id);
    //traitement du formulaire
    //1 - recupérer les données
    $btitle = $_POST['title'] ?? null;
    $price = $_POST['price'] ?? null;
    $discount = $_POST['discount'] ?? null;
    $isbn = $_POST['isbn'] ?? null;
    $author = $_POST['author'] ?? null;
    $publishedAt = $_POST['publishedAt'] ?? null;
    $errors =[];

    if(!empty($_POST)) { 
        if(empty($btitle)) {
            $errors['title']= 'Le titre est obligatoire.';
        }
        if($price<1 || $price>100) {
            $errors['price']= 'Le prix est obligatoire et doit etre compris entre 1 et 100€.';
        }
        if(!empty($discount) && ($discount>100 || $discount<0)) {
            $errors['discount']= 'La promotion doit etre comprise entre 0 et 100%.';
        }
        if(strlen($isbn) !=13 && strlen($isbn) !=10) {
            $errors['isbn']= 'L\'ISBN est invalide, il doit contenir 10 ou 13 chiffres.';
        }
        if(empty($author)) {
            $errors['author']= 'Veuillez entrer le nom de l\'auteur.';
        }

        $checked = explode('-', $publishedAt); 

        if(!checkdate($checked[1] ?? 0, $checked[2] ?? 0, (int)$checked[0])) { 
            $errors['publishedAt'] = 'La date est invalide.';
        }
        
        if(empty($errors)){ 
            edit ('UPDATE books SET title = ?, price = ?, discount = ?, isbn = ?, author = ?, publishedAt = ?, image = ?)',
            [
                $title, 
                $price, 
                empty($discount) ? null : $discount, 
                $isbn, 
                $author,
                $publishedAt,
                'uploads/01.jpg',
            ]);
    
            //avant redirection, on ajoute un message dans la session (qu'on affiche plus tard).
            ('Le livre ' .$btitle. ' a bien été modifié.');
        
            //redirection vers une page
            ('livres.php');
        }
    }
    require 'partials/header.php';
?>

    <div class="max-w-5xl mx-auto px-3">

    <?php if(!empty($errors)) { ?>
        <div class="bg-red-300 p-5 rounded border border-red-800 text-red-800 my-4">
            <!-- afffichage des messages erreur s'il y a. -->
            <?php foreach($errors as $error){?>
            <p class="text-lg text-red text-center mt-12 underline"><?= $error; ?></p>
            <?php } ?>
        </div>
        <?php }?>
        
        <form action="" method="post" class="w-1/2 mx-auto" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="title" class="block">Titre *</label>
                <input type="text" name="title" id="title" class="border-0 border-b focus:ring-0 w-full" value="<?= $title;?>">
            </div>
            <div class="mb-4">
                <label for="price" class="block">Prix *</label>
                <input type="text" name="price" id="price" class="border-0 border-b focus:ring-0 w-full" value="<?= $price;?>">
            </div>
            <div class="mb-4">
                <label for="discount" class="block">Promotion</label>
                <input type="text" name="discount" id="discount" class="border-0 border-b focus:ring-0 w-full" value="<?= $discount;?>">
            </div>
            <div class="mb-4">
                <label for="isbn" class="block">ISBN *</label>
                <input type="text" name="isbn" id="isbn" class="border-0 border-b focus:ring-0 w-full" value="<?= $isbn;?>">
            </div>
            <div class="mb-4">
                <label for="author" class="block">Auteur *</label>
                <input type="text" name="author" id="author" class="border-0 border-b focus:ring-0 w-full" value="<?= $author;?>">
            </div>
            <div class="mb-4">
                <label for="publishedAt" class="block">Publié le *</label>
                <input type="date" name="publishedAt" id="publishedAt" class="border-0 border-b focus:ring-0 w-full" value="<?= $publishedAt;?>">
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
                <button class="bg-gray-900 px-4 py-2 text-white inline-block rounded hover:bg-gray-700 duration-200">Valider les modifications</button>
            </div>
        </form>
    </div>

<?php require 'partials/footer.php';?>