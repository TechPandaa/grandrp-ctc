<?php 

// Initialize the language-module
$_language->read_module('settings');

use SleekDB\Store;
$settingsStore = new Store('settings', $databaseDirectory, $configuration);

if ($_SESSION['grandID'] == '19246'){

    if($action == 'save'){
        $sitename = $_POST['sitename'];
        $version = $_POST['version'];
        $default_language = $_POST['language'];
        $password_length = $_POST['password_length'];

        $settingsID = $settingsStore->findAll();
        $settingsID = $settingsID[0]['_id'];

        $settingsStore->updateById($settingsID, [
            "sitename" => "$sitename", 
            "version" => "$version", 
            "default_language" => "$default_language", 
            "password_length" => "$password_length"
        ]);

        header('Location: admin.php?site=settings&status=saved');
    }else{
        eval ("\$settings = \"".gettemplate("settings", "htm")."\";");
        echo $settings;
    }
}else {
    header('Location: admin.php?site=overview');
}

?>