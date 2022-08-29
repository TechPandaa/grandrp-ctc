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

    case 'login':
        define('PAGETITLE', settitle($_language->module['login']));
    break;

    default:
        define('PAGETITLE', settitle($_language->module['homepage']));
    break;

}
?>