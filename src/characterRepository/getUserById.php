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

class SelectUserById extends DBConnect
{
    private array $UserInfoLogin;

    public function setSelectUserById($idSession)
    {
        $connectDB = parent::dataBase();
        $requete = $connectDB->query('SELECT * FROM user');
        $array = $requete->fetchAll();
        foreach ($array as $item) {
            if ($item['user_id'] === $idSession) {
                $this->UserInfoLogin = $item;
            }
        }
    }

    public function getSelectUserById() : array
    {
        return $this->UserInfoLogin;
    }
}

$classInit = new SelectUserById;
$set = $classInit->setSelectUserById(1);
$get = $classInit->getSelectUserById();

var_dump($get);