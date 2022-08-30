<?php

$_language = $GLOBALS['_language'];
$_language->read_module('seo');

function settitle($string){
	return $GLOBALS['sitename'].' - '.$string;
}

switch ($GLOBALS['site']) {

    case 'car':
        define('PAGETITLE', settitle($_language->module['car']));
    break;

    case 'cars':
        define('PAGETITLE', settitle($_language->module['cars']));
    break;

    case 'login':
        define('PAGETITLE', settitle($_language->module['login']));
    break;

    case 'manufacturers':
        define('PAGETITLE', settitle($_language->module['manufacturers']));
    break;

    case 'overview':
        define('PAGETITLE', settitle($_language->module['overview']));
    break;

    case 'settings':
        define('PAGETITLE', settitle($_language->module['settings']));
    break;

    case 'users':
        define('PAGETITLE', settitle($_language->module['users']));
    break;

    default:
        define('PAGETITLE', settitle($_language->module['homepage']));
    break;

}
?>