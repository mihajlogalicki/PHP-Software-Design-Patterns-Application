<?php

// Active Record Design Pattern and Database Driven-class

class User {

  protected static $database;

  public $id;
  private $description;
  private $price_per_hour;
  private $profile_image;
  private $is_admin = 0;

  public const TYPES = ['Agency copywriters', 'Corporate copywriters', 'Freelance copywriters'];

  public function __construct($args=[]) {
    $this->description = $args['description'] ?? '';
    $this->price_per_hour = $args['price_per_hour'] ?? '';
    $this->profile_image = $args['profile_image'] ?? '';
    $this->types = $args['type'] ?? '';
  }

  public static function set_database($database){
    self::$database = $database;
  }

  public static function find_by_sql($sql){
    $result = self::$database->query($sql);
    if(!$result){
      exit("Database query failed.");
      echo $result;
    }
    return $result;
  }

  public static function find_all(){
    $sql = "SELECT users.id, description, type, price_per_hour, image, comment_text, full_name FROM users
    LEFT JOIN comments ON users.id = comments.user_id";
    return self::find_by_sql($sql); 
  }

  public static function find_by_id($id){
    $sql = "SELECT description, price_per_hour, image, comment_text, full_name FROM users
            LEFT JOIN comments ON users.id = comments.user_id ";
    $sql .= "WHERE users.id='". self::$database->escape_string($id)."'";
    $row = self::find_by_sql($sql);
    return $row->fetch_assoc();
   }

   public function create(){
     $sql = "INSERT INTO users (";
     $sql .= "description, price_per_hour, image, type";
     $sql .= ") VALUES (";
     $sql .= "'".$this->description."', ";
     $sql .= "'".$this->price_per_hour."', ";
     $sql .= "'".$this->profile_image."', ";
     $sql .= "'".$this->types."' ";
     $sql .= ")";
     $result = self::find_by_sql($sql);
     return $result;
   }

   public function update($id){
      $sql = "UPDATE users SET ";
      $sql .= "description = '".$this->description."', ";
      $sql .= "price_per_hour = '".$this->price_per_hour."', "; 
      $sql .= "type = '".$this->types."' ";
      $sql .= "WHERE id = '".self::$database->escape_string($id)."' LIMIT 1 ";
      $result = self::find_by_sql($sql);
      return $result;
   }

   public function delete($id){
     $sql = "DELETE FROM users ";
     $sql .= "WHERE id = '".$id."' LIMIT 1";
     $result = self::find_by_sql($sql);
     return $result;
   }

}

?>
