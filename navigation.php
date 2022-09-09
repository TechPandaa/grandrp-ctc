<?php 

// Initialize the language-module
$_language->read_module('admin');

eval ("\$navigation = \"".gettemplate("navigation", "htm")."\";");
echo $navigation;

?>