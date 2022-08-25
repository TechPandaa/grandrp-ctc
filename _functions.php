<?php 

// Database Stuff
$databaseDirectory = __DIR__."/database";
systeminc('database');

// Get the language functions
$language = $system_language;

systeminc('language');
$_language = new Language;
$_language->set_language($language);

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

// -- Current Year -- //

$year = time();
$currentyear = date("Y",$year);

?>