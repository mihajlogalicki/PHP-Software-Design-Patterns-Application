<?php

  require_once('functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('../private/shared/public_header.php');

  session_start();

  //Autoload class definitions
  function my_autoload($class) {
    if(preg_match('/\A\w+\Z/', $class)) {
      include('Classes/' . $class . '.class.php');
    }
  }
  spl_autoload_register('my_autoload');

  $database = db_connect();
  User::set_database($database);
  Admin::set_database($database);
  Comment::set_database($database);
  
  $session = new Session;

?>
