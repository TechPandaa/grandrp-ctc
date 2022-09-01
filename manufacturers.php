<?php 

// Initialize the language-module
$_language->read_module('manufacturers');

$filepath = "./uploads/manufacturers/";

if(isset($_GET['manufacturerID'])) $manufacturerID = $_GET['manufacturerID'];
else $manufacturerID = '';

use SleekDB\Store;
$manufacturerStore = new Store('manufacturers', $databaseDirectory, $configuration);

if($action == 'save'){
    if($_POST['last'] == 'new'){
        $name = $_POST['name'];
        $slug = generateSlug($name);
        $icon = $_FILES['icon'];

        $file_ext=strtolower(mb_substr($icon['name'], strrpos($icon['name'], ".")));
        if($file_ext==".png") {
            move_uploaded_file($icon['tmp_name'], $filepath.$icon['name']);
            @chmod($filepath.$icon['name'], 0755);
            $file = $slug.'_icon'.$file_ext;
            rename($filepath.$icon['name'], $filepath.$file);
            $icon = $file;

        }

        $newManufacturer = [
            "name" => "$name",
            "slug" => "$slug",
            "icon" => "$icon",
        ];

        $newManufacturer = $manufacturerStore->insert($newManufacturer);

        header('Location: admin.php?site=manufacturers&status=created');
    }elseif($_POST['last'] == 'edit'){
        $name = $_POST['name'];
        $slug = generateSlug($name);
        $icon = $_FILES['icon'];
        $manufacturerID = $_POST['id'];

        $file_ext=strtolower(mb_substr($icon['name'], strrpos($icon['name'], ".")));
        if($file_ext==".png") {
            move_uploaded_file($icon['tmp_name'], $filepath.$icon['name']);
            @chmod($filepath.$icon['name'], 0755);
            $file = $slug.'_icon'.$file_ext;
            rename($filepath.$icon['name'], $filepath.$file);
            $icon = $file;

        }

        $manufacturerStore -> updateById($manufacturerID, [
            "name" => "$name",
            "slug" => "$slug",
            "icon" => "$icon",
        ]);

        header('Location: admin.php?site=manufacturers&status=edited');
    }

}elseif($action == 'new'){

    eval ("\$new_manufacturer = \"".gettemplate("new_manufacturer", "htm")."\";");
    echo $new_manufacturer;
}elseif($action == 'edit'){

    $manufacturer = $manufacturerStore->findById($manufacturerID);

    $name = $manufacturer['name'];
    $icon = $manufacturer['icon'];

    eval ("\$edit_manufacturer = \"".gettemplate("edit_manufacturer", "htm")."\";");
    echo $edit_manufacturer;
}else{
    eval ("\$container_head = \"".gettemplate("container_head", "htm")."\";");
    echo $container_head;

        eval ("\$title_manufacturers = \"".gettemplate("title_manufacturers", "htm")."\";");
        echo $title_manufacturers;

        eval ("\$manufacturers_list_head = \"".gettemplate("manufacturers_list_head", "htm")."\";");
        echo $manufacturers_list_head;

            $manufacturers = $manufacturerStore->findAll();

            foreach($manufacturers as $manufacturer){

                $name = $manufacturer['name'];
                $id = $manufacturer['_id'];
                
                $icon = $manufacturer['icon'];

                $actions = '<a class="button small secondary" href="admin.php?site=manufacturers&action=edit&manufacturerID='.$id.'">'.$_language->module['edit'].'</a>';

                eval ("\$manufacturers_list_item = \"".gettemplate("manufacturers_list_item", "htm")."\";");
                echo $manufacturers_list_item;
            }

        eval ("\$manufacturers_list_foot = \"".gettemplate("manufacturers_list_foot", "htm")."\";");
        echo $manufacturers_list_foot;

    eval ("\$container_foot = \"".gettemplate("container_foot", "htm")."\";");
    echo $container_foot;
}

?>