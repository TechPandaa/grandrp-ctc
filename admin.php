<?php

include_once('_settings.php');
include_once('_functions.php');

// Initialize the language-module
$_language->read_module('admin');

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo PAGETITLE; ?></title>
    <link rel="stylesheet" href="static/css/style.css">
</head>
<body>
    <div id="background">
        <img src="static/img/backgrounds/bg1.jpg" alt="Background Image">
    </div>
    <div id="content">
        <header>
            <div class="container flex flex-nowrap flex-space-between flex-align-center">
                <div id="logo">
                    <a href="index.php">
                        <img src="static/img/grandrp-logo.svg" alt="Grand RP Logo">
                        <div id="sitename">
                            <span class="white bold uppercase">Car Thief</span>
                            <span class="secondary light uppercase">Calculator</span>
                        </div>
                    </a>
                </div>
                <?php include('user.php'); ?>
            </div>
        </header>
        <div id="sub-header">
            <div class="container">
                <nav class="flex flex-wrap flex-nowrap">
                    <span class="uppercase bold"><?php echo $_language->module['admin']; ?></span>
                    <ul class="flex flex-wrap flex-nowrap">
                        <li>
                            <a href="admin.php?site=manufacturers"><?php echo $_language->module['manufacturers']; ?></a>
                        </li>
                        <li>
                            <a href="admin.php?site=cars"><?php echo $_language->module['cars']; ?></a>
                        </li>
                        <li>
                            <a href="admin.php?site=users"><?php echo $_language->module['users']; ?></a>
                        </li>
                        <li>
                            <a href="admin.php?site=settings"><?php echo $_language->module['settings']; ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <main>
            <?php
                if(!isset($site)) $site="overview";
                $invalide = array('\\','/','/\/',':','.');
                $site = str_replace($invalide,' ',$site);
                if(!file_exists($site.".php")) $site = "overview";
                include($site.".php");
            ?>
        </main>
        <footer>
            <div class="container">
                <div id="footer-left">
                    <div id="copyright">
                        Copyright &copy; <?php echo date('Y'); ?> <a href="https://twitter.com/techpandaa">@TechPandaa</a> - <?php $_language->read_module('index'); echo $_language->module['rights']; ?>
                    </div>
                    <div id="version">
                        Version <span class="secondary"><?php echo $version; ?></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>