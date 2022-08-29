<?php 

include_once('_settings.php');
include_once('_functions.php');

// Initialize the language-module
$_language->read_module('login');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sitename; echo ' - Login'; ?></title>
    <link rel="stylesheet" href="static/css/style.css">
</head>
<body>
    <div id="background">
        <img src="static/img/backgrounds/bg4.jpg" alt="Background Image">
    </div>
    <div id="content">
        <div class="container flex flex-wrap flex-nowrap flex-justify-center">
            <div id="login" class="flex flex-column flex-nowrap flex-justify-center">
                <div id="logo" class="flex flex-wrap flex-nowrap flex-justify-center">
                    <img src="static/img/grandrp-logo.svg" alt="Grand RP Logo">
                    <div id="sitename" class="flex flex-column flex-nowrap flex-justify-center">
                        <span class="white bold uppercase">Car Thief</span>
                        <span class="secondary light uppercase">Calculator</span>
                    </div>
                </div>
                <form id="login" class="flex flex-column flex-nowrap flex-space-even flex-align-center" action="checklogin.php" method="post">
                    <label for="grandid"><?php echo $_language->module['grandid']; ?></label>
                    <input type="text" name="grandid" id="grandid" placeholder="19246">
                    <label for="password"><?php echo $_language->module['password']; ?></label>
                    <input type="password" name="password" id="password">
                    <input class="uppercase" type="submit" value="<?php echo $_language->module['login']; ?>">
                </form>
            </div>
        </div>
    </div>
</body>
</html>