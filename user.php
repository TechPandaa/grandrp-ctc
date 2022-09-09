<?php
// Initialize the language-module
$_language->read_module('users');

$name = getUserName($userID);
$email = getUserEmail($userID);
$gravatar = getGravatar($email);

eval ("\$user = \"".gettemplate("user", "htm")."\";");
echo $user;
?>