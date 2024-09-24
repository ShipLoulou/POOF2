<?php

function homepage() {

    require_once "templates/homepage.php";
}

function login() {
    require_once "templates/signInpage.php";
    
}

$output = match (true) {
    $_GET["page"] === "singin"  => login(),
    $_GET["page"] === ""  => homepage(),
    default => homepage()
};

