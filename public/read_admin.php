<?php require_once('../private/initialize.php'); ?>

<div class="container-fluid">
<table class="table-bordered">
  <thead>
    <tr class="table-secondary">
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Price per hour</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
<?php


$session->require_login();
$users = User::find_all();
$new_comments = Comment::find_new_comments();

$comment = new Comment;
// ADMIN comment editing
if(isset($_POST['approve_comment'])){
    $comment->approve_comment($_POST['commentId']);
} 
if(isset($_POST['reject_comment'])){
    $comment->reject_comment($_POST['commentId']);
} 


?>  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php if($session->is_logged_in()) { ?>
          <p><a class="navbar-brand" href="<?php echo url_to('create_admin.php') ?>">Add Profile</a></p>
          <p><a class="navbar-brand" href="<?php echo url_to('home_page.php') ?>">&nbsp Back to Home</a></p>
          <p><a class="navbar-brand" href="<?php echo url_to('logout.php') ?>">&nbsp Logout</a></p>
     <?php } ?>
</nav>
      <?php foreach($users as $user) { ?>
       <tbody>
      <tr class="table-primary">
        <td style="width: 840px;"><?php  echo h($user['description']); ?></td>
        <td  class="w-25"><img  class="w-25 p-0" src="../private/uploads/<?php echo $user['image'] ?>"></td>
        <td><?php echo h(money_format('$%i', $user['price_per_hour'])); ?></td>
        <td>
          <a style="font-size: 110%;" class="text-light bg-dark" href="update_admin.php?id=<?php echo h($user['id']); ?>">Edit</a>
          <a style="font-size: 110%;" class="text-light bg-dark" href="delete_admin.php?id=<?php echo h($user['id']); ?>">Delete</a>
        </td>
      </tr>
      <?php } ?>
  </tbody>
</table><br>
<h4>Approve or Reject comments</h4>
<div class="list-group">
  <?php foreach($new_comments as $user) { ?>
    <div class="panel-body">
<ul class="list-group">
<li class="list-group-item">
<div class="row">
    <div class="col-xs-10 col-md-11">
        <div>
            By: <?php echo $user['full_name']; ?>
            <div class="mic-info">
            <b>Comment:</b> <?php echo $user['comment_text']; ?>
            </div>
        </div>
        <div class="comment-text">
        Type: <?php echo $user['type']; ?>
      </div>
    </div>
</div>
</li>
</ul>
</div>
      <span>
      <form action="read_admin.php" method="POST">
        <input type="hidden" name="commentId" value=<?php echo $user['id'];?>>
        <button  name="approve_comment" class="btn btn-primary">Approve</button></td>
        <button  name="reject_comment" class="btn btn-danger">Delete</button></td>
        </form>	
      </span><br>
     </ul>
    <?php } ?>
  </a>
</div>
</div>
</div>


 




