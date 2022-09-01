<?php 

session_start();
require_once "./vendor/autoload.php";

// Database Location
$databaseDirectory = __DIR__."/database";

use SleekDB\Store;

$userStore = new Store('users', $databaseDirectory);

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['grandid'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the GrandID and Password fields!');
}

$formID = $_POST['grandid'];
$user = $userStore->findBy(["grandID", "=", "$formID"]);
$count = $userStore->count(["grandID", "=", "$formID"]);

// Prepare the database query for the login data.
if ($count > 0) {

    $grandID = $user[0]["grandID"];
    $password = $user[0]["password"];
    $id = $user[0]["_id"];

    if(isset($formID) > 0){
        // Check if the password is correct
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has loggedin!
            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['grandID'] = $grandID;
            $_SESSION['userID'] = $id;

            header('Location: admin.php');
         } else {
            echo 'Incorrect Password!';
        }
    } else {
      echo 'Incorrect GrandID!';
  }
}

?>