<?php

declare(strict_types=1);

namespace App\Repository;

require "src/config.php";

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

class getAllUsers extends DBConnect
{
    private array $allUsers;

    public function setSelectUserById() : void
    {
        $connectDB = parent::dataBase();
        $requete = $connectDB->query('SELECT * FROM user');
        $this->allUsers = $requete->fetchAll();
    }

    public function getSelectUserById() : array
    {
        return $this->allUsers;
    }
}

$classInit = new getAllUsers;
$set = $classInit->setSelectUserById();
$get = $classInit->getSelectUserById();

var_dump($get);