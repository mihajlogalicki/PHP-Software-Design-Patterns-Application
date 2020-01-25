<?php 

class Comment {

    protected static $database;

    private $comment_text;
    private $full_name;
    public $user_id;

    public function __construct($args = []){
        $this->comment_text = $args['comment_text'] ?? '';
        $this->full_name = $args['full_name'] ?? '';
        $this->user_id = $args['user_id'] ?? '';
    }

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

    public static function find_comments_by_profile($user_id){
        $sql = "SELECT * FROM comments ";
        $sql .= "WHERE user_id = '".$user_id."' AND status = 1";
        $result = self::find_by_sql($sql);
        return $result;
    }

    public  function create(){
        $sql = "INSERT INTO comments (";
        $sql .= "comment_text, full_name, user_id";
        $sql .= ") VALUES (";
        $sql .= "'".$this->comment_text."', ";
        $sql .= "'".$this->full_name."', ";
        $sql .= "'".$this->user_id."' ";
        $sql .= ")";
        $result = self::find_by_sql($sql);
        return $result;
    } 
        
    public static function approve_comment($id){
        $sql = "UPDATE comments SET status = 1 WHERE id =  '".$id."' ";
        $result= self::find_by_sql($sql);
        if($result){
            redirect_to('read_admin.php');
        }
    }

    public function reject_comment($id){
        $sql = "DELETE FROM comments WHERE id =  '".$id."' ";
        $result= self::find_by_sql($sql);
        if($result){
            redirect_to('read_admin.php');
        }
    }

    public static function find_new_comments(){
        $sql = "SELECT comments.id, description, type, price_per_hour, image, comment_text, full_name FROM users
        INNER JOIN comments ON users.id = comments.user_id WHERE status = 0";
        return self::find_by_sql($sql); 
      }
}

?>