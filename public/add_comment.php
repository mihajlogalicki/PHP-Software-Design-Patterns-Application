<?php

require('../private/initialize.php');

if(is_post_request()){

    $args = [];
    $args['full_name'] = $_POST['full_name'];
    $args['comment_text'] = $_POST['comment_text'];
    $args['user_id'] = $_POST['user_id'];

    $comment = new Comment($args);
    if($comment->create()){
        redirect_to('detail.php?id=' . $args['user_id']);
    }
}

?>