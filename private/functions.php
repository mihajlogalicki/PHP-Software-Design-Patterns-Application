<?php

function url_to($url="") {
  return $url;
}

function h($string="") {
  return htmlspecialchars($string);
}

function redirect_to($location) {
  header("Location: " . $location);
  
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}


function money_format($format, $number) {
    return '$' . number_format($number, 2);
}

function validation_profile_image($img_name){

  $img_name = $_FILES['profile_image']['name'];
  $img_tmp = $_FILES['profile_image']['tmp_name'];
  $file_size = $_FILES['profile_image']['size'];

  // paths, extensions
  $extensions = ["jpg", "png", "jpeg"];
  $file_type = pathinfo($img_name, PATHINFO_EXTENSION);
  if(!in_array($file_type, $extensions) || $file_size > 1024000 || empty($img_name)){
      return false;
   } 
      return true;
 }

 function is_blank($value) {
  return !isset($value) || trim($value) === '';
}


?>
