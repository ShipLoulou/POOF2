<?php

session_start();

/**
 * Me connecter à ma BDD
 */
abstract class DBConnect
{
    protected static function dataBase() 
    {
        $dsn="mysql:dbname=".BASE.";host=".SERVER;
        try {
            return $mysqlClient=new \PDO($dsn,USER,PASSWD);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}


class CreateAccount extends DBConnect
{
    private bool $checkPassword = false;

    /**
     * Vérifie que les données saisie soit correctes
     */
    public function treatment() : void
    {
        $output = match (true) {
            empty($_POST['firstName']) 
            || empty($_POST['lastName']) 
            || empty($_POST['pseudo'])  
            || empty($_POST['email']) 
            || empty($_POST['password'])
            || strlen($_POST['pseudo']) < 4
            || $this->checkPassword === false => $this->error(),
            $this->checkPassword === true => $this->redirection(),
            default => $this->errorMessage = $this->error()
        };
    }

    /**
     * Vérification de la validité du mot de passe
     */
    public function checkPassword() : void
    {
        if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{4,8}$/", $_POST['password'])) {
            $this->checkPassword = true;
        } else {
            $this->checkPassword = false;
        }
    }

    /**
     * Gestion des erreurs
     * un message d'erreur est insérer dans $_SESSION
     */
    public function error()  
    {
        $outputError = match (true) {
            empty($_POST['firstName']) 
            || empty($_POST['lastName']) 
            || empty($_POST['pseudo'])  
            || empty($_POST['email']) 
            || empty($_POST['password']) => "Tous les champs sont obligatoires",
            strlen($_POST['pseudo']) < 4  => "Le pseudo doit avoir au minimun 4 caractères",
            $this->checkPassword === false => "Le mot de passe doit avoir 1 majuscule, 1 minuscule, un nombre et doit contenir entre 6 à 13 caractères",
            default => "Error"
        };

        $_SESSION['error'] = [
            'errorMessage' => $outputError,
        ];

        header('Location: ../../index.php?page=singin');
        exit;
    }

    /**
     * Transmet les données saisie dans la BDD
     * Redirection vers le page personnel de l'utilisateur
     */
    public function redirection() 
    {
        unset($_SESSION['error']);
        header('Location: ../../index.php?page=singin');
        exit;
    }

}

$callSignIn = new CreateAccount;
$checkPassword = $callSignIn->checkPassword();
$treatment = $callSignIn->treatment();
$response = $callSignIn->error();
?>
<pre>
    <?php
    var_dump($_SESSION);
    var_dump($response);
    var_dump($_POST);
    ?>
</pre>