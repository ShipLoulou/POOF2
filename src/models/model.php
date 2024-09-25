<?php

session_start();

require '../controllers/contoller.php';
require '../characterRepository/CRUD.php';

/**
 * Instance de la class du controller qui vérifie le bonne conformité des information saisie
 */
$callSignIn = new VerificationCreateAccount;
$checkPassword = $callSignIn->checkPassword();
$treatment = $callSignIn->treatment();
$error = $callSignIn->error();
$redirection = $callSignIn->redirection();

/**
 * Insence de la class GET qui parcours la table user dans la BDD
 */
$getClassInit = new GET;
$getSendData = $getClassInit->set($mysqlClient, 'user');
$getResponse = $getClassInit->get();

/**
 * Variable qui indique si oui ou non le pseudo ou l'email saisie à déjà été enregister
 */
$userAlreadyRegistered = false;

foreach ($getResponse as $user) {
    if ($user['pseudo'] === $_POST['pseudo'] || $user['email'] === $_POST['email']) {
        $userAlreadyRegistered = true;
    }
}

if ($userAlreadyRegistered === true) {
    $_SESSION['error'] = [
        'errorMessage' => "Le pseudo ou l'email est déjà utilisé",
    ];
    header('Location: ../../index.php?page=singin');
    exit;
} else {
    if ($redirection === true) {
        unset($_SESSION['error']);
        
        /**
         * Insence de la class ADD_USER qui ajoute un utilisateur dans la BDD
         */
        $addClassInit = new ADD_USER;
        $sendRequete = $addClassInit->sendRequete($mysqlClient, $_POST);
        var_dump($sendRequete);
        
        header('Location: ../../index.php?page=');
        exit;
    } else {
        $_SESSION['error'] = [
            'errorMessage' => $error,
        ];
        header('Location: ../../index.php?page=singin');
        exit;
    }
}