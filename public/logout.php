<?php
require('../private/initialize.php');

$session->logout($admin);
redirect_to('login.php');
?>