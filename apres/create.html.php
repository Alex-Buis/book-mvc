<?php require 'partials/header.html.php'; ?>

<div class="max-w-5xl mx-auto">
    <?php foreach ($errors as $error) { ?>
    <p> <?= $error; ?> </p>
    <?php } ?>
    <form action="" method="post">
        <input type="text" name="name" value="<? $user->name;?>">

        <button>Sauvegarder</button>
    </form>
</div>

<?php require 'partials/footer.html.php'; ?>