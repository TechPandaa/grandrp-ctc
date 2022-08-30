<?php 

// Initialize the language-module
$_language->read_module('users');

if(isset($_GET['userID'])) $userID = $_GET['userID'];
else $userID = '';

use SleekDB\Store;
$userStore = new Store('users', $databaseDirectory);

if($action == 'new'){
    eval ("\$new_user = \"".gettemplate("new_user", "htm")."\";");
    echo $new_user;
}elseif($action == 'edit'){
    $user = $userStore->findById($userID);

    if(isset($user['name'])){
        $name = $user['name'];
    }else {
        $name = '';
    }

    if(isset($user['email'])){
        $email = $user['email'];
    }else {
        $email = '';
    }

    eval ("\$edit_user = \"".gettemplate("edit_user", "htm")."\";");
    echo $edit_user;
}elseif($action == 'save'){
    if($_POST['last'] == 'new'){

    }elseif($_POST['last'] == 'edit'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        $userStore->updateById($id, ["name" => "$name", "email" => "$email"]);

        header('Location: admin.php?site=users&status=edited');

    }

}elseif($action == 'delete'){
}else{
    eval ("\$container_head = \"".gettemplate("container_head", "htm")."\";");
    echo $container_head;

        eval ("\$title_users = \"".gettemplate("title_users", "htm")."\";");
        echo $title_users;

        eval ("\$users_list_head = \"".gettemplate("users_list_head", "htm")."\";");
        echo $users_list_head;

            $users = $userStore->findAll();

            foreach($users as $user){

                $grandid = $user['grandID'];
                $name = $user['name'];
                $id = $user['_id'];

                $actions = '<a class="button small secondary" href="admin.php?site=users&action=edit&userID='.$id.'">'.$_language->module['edit'].'</a>';

                eval ("\$users_list_item = \"".gettemplate("users_list_item", "htm")."\";");
                echo $users_list_item;
            }

        eval ("\$users_list_foot = \"".gettemplate("users_list_foot", "htm")."\";");
        echo $users_list_foot;

    eval ("\$container_foot = \"".gettemplate("container_foot", "htm")."\";");
    echo $container_foot;
}

?>