<?php

require "../models/bdd.php";

/**
 * Parcourt de la BDD
 */
class GET
{
    private array $response;
    
    public function set($mysqlClient, $tableName) : void
    {
        $requete = $mysqlClient;
        $result = $requete->query("SELECT * FROM $tableName");
        $this->response = $result->fetchAll();
    }
    
    public function get() : array
    {
        return $this->response;
    }
}

/**
 * Enregistre un nouvel utilisateur dans la BDD
 */
class ADD_USER
{
    public function sendRequete($mysqlClient, $dataForm)
    {
        $requete = $mysqlClient;
        $result = $requete->prepare('INSERT INTO user(firstName, lastName, pseudo, profileImage, email, password) VALUES (:firstName, :lastName, :pseudo, :profileImage, :email, :password)');
        $result->execute([
            'firstName' => strip_tags($dataForm['firstName']),
            'lastName' => strip_tags($dataForm['lastName']),
            'pseudo' => strip_tags($dataForm['pseudo']),
            'profileImage' => "https://img.freepik.com/photos-premium/avatar-dessin-anime-3d-immersif-vue-captivante-profil-homme-blanc-10-ans-h-noir_983420-10038.jpg",
            'email' => strip_tags($dataForm['email']),
            'password' => strip_tags($dataForm['password']),
        ]);
    }

}