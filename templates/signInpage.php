<?php
    session_start();

    $title = "POOF • Sing In";
    $classBody = "singin";
?>

<?php ob_start(); ?>

    <?php require "templates/elements/header.php" ?>
    <main>
        <div class="wrapperForm">
            <h1>S'inscrire</h1>
            <form action="src/characterRepository/createAccount.php" method="post">
                <div>
                    <label for="firstName">Prénom</label>
                    <input type="text" id="firstName" name="firstName" >
                </div>
                <div>
                    <label for="lastName">Nom</label>
                    <input type="text" id="lastName" name="lastName" >                    
                </div>
                <div>
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Au moins 4 caractères">                    
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" >                    
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="Au moins 6 caractères">                    
                </div>
                <div>
                    <?php if ($_SESSION['error'] !== null) : ?>
                    <div class="error">
                        <p><?= $_SESSION['error']['errorMessage'] ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <input type="submit" value="S'inscrire">
            </form>
        </div>
    </main>
    <?php require "templates/elements/footer.php" ?>

<?php 
    $content = ob_get_clean();
    require "templates/elements/layout.php";
?>
