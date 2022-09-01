<?php 

// Initialize SleekDB
use SleekDB\Store;

function createDatalist ($name, $filter, $option){

    $databaseDirectory = "./database";
    $configuration = [
        "auto_cache" => true,
        "cache_lifetime" => null,
        "timeout" => false // deprecated! Set it to false!
    ];
    $database = new Store("$name", $databaseDirectory, $configuration);

    if($filter){
        $data = $database->findBy(["$filter", "=", "$option"], ["name" => "asc"]);
        $datalist = '<datalist id="'.$option.'">';
    }else{
        $data = $database->findAll(["name" => "asc"]);
        $datalist = '<datalist id="'.$name.'">';
    }
    
    foreach($data as $row){
        $datalist .= '<option data-value="'.$row['_id'].'" value="'.$row['name'].'"></option>';
    }

    $datalist .= '</datalist>';
    return $datalist;
}

?>