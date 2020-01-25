<?php 
require('../private/initialize.php');

$session->require_login();

$id = $_GET['id'] ?? false;

$user = new User;
if($user->delete($id)){
    redirect_to('read_admin.php');
}


?>