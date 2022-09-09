<?php 

// Get the language functions
$language = $system_language;

systeminc('language');
$_language = new Language;
$_language->set_language($language);


// -- Additional Database Functions -- //
systeminc('database');

// Filter REQUEST_URI for use with causes
function page($page){
	$page = str_replace('/', '', $_SERVER['REQUEST_URI']);
	$page = str_replace('.php', '', $page);
	return $page;
}

$page = page($_SERVER['REQUEST_URI']);

// -- SITE VARIABLE -- //

if(isset($_GET['site'])) $site = $_GET['site'];
elseif(($page == 'index')) $site = 'homepage';
else $site = 'overview';

// -- Action Variable -- //

if(isset($_GET['action'])) $action = $_GET['action'];
else $action = '';

// -- Template Function -- //

function gettemplate($template,$endung="htm", $calledfrom="root") {
	$templatefolder = "templates";
	if($calledfrom=='root') {
		return str_replace("\"", "\\\"", $GLOBALS['_language']->replace(file_get_contents($templatefolder."/".$template.".".$endung)));
	}
	elseif($calledfrom=='backend') {
		return str_replace("\"", "\\\"", $GLOBALS['_language']->replace(file_get_contents("../".$templatefolder."/".$template.".".$endung)));
	}
}

// -- SEARCH ENGINE OPTIMIZATION (SEO) -- //

if(stristr($_SERVER['PHP_SELF'],"/admin/") == false){
	systeminc('seo');
}
else{
	define('PAGETITLE', $GLOBALS['hp_title']);
}

// Slug Generator for URLS und Dropdown Menus

function generateSlug($string)
{
    $string=strtolower($string);
	$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return $slug;
}

// -- User Stuff -- //
systeminc('users');
if(isset($_SESSION['userID'])) $userID = $_SESSION['userID'];
else $userID = '';

// -- RANDOM PASSWORD CREATION -- //

function new_password($length){
    $bytes = openssl_random_pseudo_bytes($length);
    $password = bin2hex($bytes);
    return $password;
}

// -- Current Year -- //

$year = time();
$currentyear = date("Y",$year);

?>