<?php 

require_once "./vendor/autoload.php";

// Get all Session information about the loggedin admin
session_start();

// Database Stuff
$databaseDirectory = __DIR__."/database";

// -- ERROR REPORTING -- //
define('DEBUG', "ON"); // ON = development-mode | OFF = public mode
if (DEBUG === 'ON') {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

// -- SYSTEM FILE INCLUDE -- //

function systeminc($file)
{
    if (!include('src/' . $file . '.php')) {
        if (DEBUG == "OFF") {
            echo 'Could not get system file for <mark>' . $file . '</mark>';
        } else {
            echo 'Could not get system file for <mark>' . $file . '</mark>';
        }
    }
}

use SleekDB\Store;
$settingsStore = new Store('settings', $databaseDirectory);

$settings = $settingsStore->findAll();

/** General Settings */
$sitename = $settings[0]['sitename'];
$version = $settings[0]['version'];
$system_language = $settings[0]['default_language'];
$password_length = $settings[0]['password_length'];

?>