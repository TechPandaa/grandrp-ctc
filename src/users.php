<?php 

// Initialize SleekDB
use SleekDB\Store;

function getUserName($userID){
    global $databaseDirectory;
    global $configuration;

    // User Store
    $userStore = new Store('users', $databaseDirectory, $configuration);

    $user = $userStore->findById($userID);
    return $user['name'];
}

function getUserEmail($userID){
    global $databaseDirectory;
    global $configuration;
    
    // User Store
    $userStore = new Store('users', $databaseDirectory, $configuration);

    $user = $userStore->findById($userID);
    return $user['email'];
}

function getGravatar($email){
    $email = md5($email);
    $default = $_SERVER['HTTP_HOST'] . "/static/img/gravatar.png";
    $size = 40;
    $gravatar = "https://www.gravatar.com/avatar/$email?d=$default&s=$size";
    return $gravatar;
}

?>