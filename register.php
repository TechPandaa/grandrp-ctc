<?php 

include_once('_settings.php');
include_once('_functions.php');

// Initialize the language-module
$_language->read_module('login');

use SleekDB\Store;
use SleekDB\Query;

$userStore = new Store("users", $databaseDirectory);

if($action == 'save'){

    // Form Data
    $grandID = $_POST['grandid'];
    $password = $_POST['password'];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $newUser = [
        "grandID" => "$grandID",
        "password" => "$passwordHash",
    ];

    $newUser = $userStore->insert($newUser);

    header('Location: login.php');

}else {
    eval ("\$register_form = \"".gettemplate("register_form", "htm")."\";");
    echo $register_form;
}

?>