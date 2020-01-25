<?php

class Admin {

    protected static $database;

    private $id;
    private $name;
    private $username;
    private $password;

    public static function set_database($database){
        self::$database = $database;
    }

    public static function find_by_sql($sql){
        $result = self::$database->query($sql);
        if(!$result){
            exit("Database query failed.");
        }
        return $result;
    }

    public static function check_is_admin($username, $password){
        $sql = "SELECT * FROM admins ";
        $sql .= "WHERE username = '". self::$database->escape_string($username)."' AND ";
        $sql .= "password  = '".   self::$database->escape_string($password)."' AND ";
        // ADMIN with permission chief administrator
        $sql .= "permission = 1 ";
        $row = self::find_by_sql($sql);
        return $row->fetch_assoc();
    }
}

?>