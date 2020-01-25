<?php

class Session {

    private $admin_id;

    public function set_session($admin){
        session_start();
        $_SESSION['admin_id'] = $admin;
    }

    public function is_logged_in(){
        return isset($_SESSION['admin_id']);
    }

    public function logout(){
        unset($_SESSION['admin_id']);
        unset($this->admin_id);
    }

    public function require_login(){
        if(!$this->is_logged_in()){
            return redirect_to('login.php');
        }
    }

}

?>