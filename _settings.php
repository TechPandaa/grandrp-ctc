<?php 

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

/** General Settings */
$version = '0.1-Alpha';
$sitename = 'Grand RP - Car Thief Calculator';
$system_language = 'de';

?>