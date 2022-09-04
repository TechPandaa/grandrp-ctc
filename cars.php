<?php 

// Initialize the language-module
$_language->read_module('cars');

$filepath = "./uploads/cars/";

if(isset($_GET['carID'])) $userID = $_GET['carID'];
else $carID = '';

use SleekDB\Store;
$carsStore = new Store('cars', $databaseDirectory, $configuration);

if($action == 'new'){
    $manufacturers = createDatalist('manufacturers', NULL, NULL);

    eval ("\$new_car = \"".gettemplate("new_car", "htm")."\";");
    echo $new_car;
}elseif($action == 'edit'){
    $carID = $_GET['carID'];
    $car = $carsStore->findById($carID);

    $name = $car['name'];
    $handle = $car['handle'];
    $year = $car['attributes']['year'];
    $value = $car['attributes']['value'];

    $manufacturer = $car['attributes']['manufacturer'];
    $manufacturers = createDatalist('manufacturers', NULL, NULL);

    $dlc = $car['extras']['dlc'];
    $gconly = $car['extras']['gconly'];
    $lottery = $car['extras']['lottery'];

    if($dlc == 'on'){
        $dlc = 'checked';
    }else{
        $dlc = '';
    }

    if($gconly == 'on'){
        $gconly = 'checked';
    }else{
        $gconly = '';
    }

    if($lottery == 'on'){
        $lottery = 'checked';
    }else{
        $lottery = '';
    }

    $copyright = $car['graphics']['copyright'];

    eval ("\$edit_car = \"".gettemplate("edit_car", "htm")."\";");
    echo $edit_car;
}elseif($action == 'save'){
    if($_POST['last'] == 'new'){
        $name = $_POST['name'];
        $handle = $_POST['handle'];
        $year = $_POST['year'];
        $manufacturer = $_POST['manufacturer'];
        $value = $_POST['value'];

        $dlc = $_POST['extras']['dlc'];
        $gconly = $_POST['extras']['gconly'];
        $lottery = $_POST['extras']['lottery'];

        $picture = $_FILES['picture'];
        $file_ext=strtolower(mb_substr($picture['name'], strrpos($picture['name'], ".")));
        if($file_ext==".png" OR $file_ext==".jpg") {
            move_uploaded_file($picture['tmp_name'], $filepath.$picture['name']);
            @chmod($filepath.$picture['name'], 0755);
            $file = $handle.$file_ext;
            rename($filepath.$picture['name'], $filepath.$file);
            $picture = $file;

        }
        $copyright = $_POST['copyright'];

        $newCar = [
            "name" => "$name",
            "handle" => "$handle",
            "attributes" => [
                "year" => "$year",
                "manufacturer" => "$manufacturer",
                "value" => "$value",
            ],
            "extras" => [
                "dlc" => "$dlc",
                "gconly" => "$gconly",
                "lottery" => "$lottery"
            ],
            "graphics" => [
                "picture" => "$picture",
                "copyright" => "$copyright",
            ],
        ];
        $newCar = $carsStore->insert($newCar);

        header('Location: admin.php?site=cars&status=created');
    }elseif($_POST['last'] == 'edit'){
        $carID = $_POST['carID'];
        $name = $_POST['name'];
        $handle = $_POST['handle'];
        $year = $_POST['year'];
        $manufacturer = $_POST['manufacturer'];
        $value = $_POST['value'];

        $dlc = $_POST['dlc'];
        $gconly = $_POST['gconly'];
        $lottery = $_POST['lottery'];

        $picture = $_FILES['picture'];
        $file_ext=strtolower(mb_substr($picture['name'], strrpos($picture['name'], ".")));
        if($file_ext==".png" OR $file_ext==".jpg") {
            move_uploaded_file($picture['tmp_name'], $filepath.$picture['name']);
            @chmod($filepath.$picture['name'], 0755);
            $file = $handle.$file_ext;
            rename($filepath.$picture['name'], $filepath.$file);
            $picture = $file;

        }
        $copyright = $_POST['copyright'];

        $carsStore -> updateById($carID, [
            "name" => "$name",
            "handle" => "$handle",
            "attributes" => [
                "year" => "$year",
                "manufacturer" => "$manufacturer",
                "value" => "$value",
            ],
            "extras" => [
                "dlc" => "$dlc",
                "gconly" => "$gconly",
                "lottery" => "$lottery"
            ],
            "graphics" => [
                "picture" => "$picture",
                "copyright" => "$copyright",
            ],
        ]);

        header('Location: admin.php?site=cars&status=edited');
    }

}else{
    eval ("\$container_head = \"".gettemplate("container_head", "htm")."\";");
    echo $container_head;

        eval ("\$title_cars = \"".gettemplate("title_cars", "htm")."\";");
        echo $title_cars;

        eval ("\$cars_list_head = \"".gettemplate("cars_list_head", "htm")."\";");
        echo $cars_list_head;

            $cars = $carsStore->findAll();

            foreach($cars as $car){

                $name = $car['name'];
                $handle = $car['handle'];
                $manufacturer = $car['attributes']['manufacturer'];
                $id = $car['_id'];

                $actions = '<a class="button small secondary" href="admin.php?site=cars&action=edit&carID='.$id.'">'.$_language->module['edit'].'</a>';

                eval ("\$cars_list_item = \"".gettemplate("cars_list_item", "htm")."\";");
                echo $cars_list_item;
            }

        eval ("\$cars_list_foot = \"".gettemplate("cars_list_foot", "htm")."\";");
        echo $cars_list_foot;

    eval ("\$container_foot = \"".gettemplate("container_foot", "htm")."\";");
    echo $container_foot;
}

?>