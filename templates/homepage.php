<?php
    $title = "homepage";
    $classBody = "homepage";
?>

<?php ob_start(); ?>

    <?php require "templates/elements/header.php" ?>
    <main>
        <h1>Partager vos voyages avec POOF !</h1>
        <p>Ajoutez vos amis et partager vos expériences</p>
    </main>
    <?php require "templates/elements/footer.php" ?>

<?php 
    $content = ob_get_clean();
    require "templates/elements/layout.php";
?>
