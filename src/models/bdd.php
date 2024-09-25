<?php
/**
 * Connection à la BDD
 */

require "../config.php";

$dsn="mysql:dbname=$PARAM_BASE;host=$PARAM_SERVER;charset=utf8";

$mysqlClient=new PDO($dsn,$PARAM_USER,$PARAM_PASSWD);
