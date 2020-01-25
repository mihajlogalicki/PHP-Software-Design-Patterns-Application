<?php 

require('../private/initialize.php');

$errors = [];

if(is_post_request()){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if(is_blank($username)){
        $errors[] = "Username cannot be blank.";
    }
    if(is_blank($password)){
        $errors[] = "Password cannot be blank.";
    }

    if(empty($errors)){
        $admin = Admin::check_is_admin($username, $password);
        if($admin){
            $session->set_session($admin);
            redirect_to('read_admin.php');
        } else {
            redirect_to('login.php');
        }
    } else {
        $errors[] = "Log in was unsuccesfull";
    }
}

?>

<form method="POST"  action="login.php">
    <div class="form-group col-lg-2">
      <h2>Login</h2>
    </div>
    <div class="form-group col-lg-2">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username">
    </div>
    <div class="form-group col-lg-2">
        <label for="price_per_hour">Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <div class="form-group col-lg-2">
      <input type="submit" name="login" class="btn btn-primary">
    </div>
</form>