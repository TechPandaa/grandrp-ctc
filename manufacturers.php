<?php 

// Initialize the language-module
$_language->read_module('manufacturers');

use SleekDB\Store;
$manufacturerStore = new Store('manufacturers', $databaseDirectory);

if($action == 'save'){
    if($_POST['last'] == 'new'){
        header('Location: admin.php?site=manufacturers&status=created');
    }elseif($_POST['last'] == 'edit'){
        header('Location: admin.php?site=manufacturers&status=edited');
    }

}elseif($action == 'new'){

    eval ("\$new_manufacturer = \"".gettemplate("new_manufacturer", "htm")."\";");
    echo $new_manufacturer;
}elseif($action == 'edit'){

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
                
                $icon = $manufacturer['icon'];
                $icon = '<img src="uploads/manufacturers/'.$icon.'" alt="'.$name.'" />';

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