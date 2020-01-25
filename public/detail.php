<?php require_once('../private/initialize.php');

$id = $_GET['id'] ?? false;
$user = User::find_by_id($id);

?>
<div class="container">
<div class="card text-center">
<h5 class="card-header">Detail Profile</h5>
  <div class="card-body">
    <h5 class="card-title"><img style="width: 450px;height: 350px;" src="../private/uploads/<?php echo $user['image'] ?>"></h5>
    <p class="card-text">
    <h5 class="card-title"><?php echo h(money_format('$%i', $user['price_per_hour'])); ?> per hour</h5>
    <p class="card-title"><?php echo h($user['description']); ?>.</p>.</p>
  </div>
</div><br>
<div class="card text-center border-0">
<h5 class="card-title-center">Leave a comment</h5>
  <div class="card-title-center">
    <form method="POST" class="text-center" action="add_comment.php">
    <input type="hidden" name="user_id" value=<?php echo $id; ?>>
      <div class="form-group col-md-12">
          <label for="full_name">FULL NAME*</label>
          <input type="text" class="form-control" name="full_name">
      </div>
      <div class="form-group col-lg-12">
      <label for="comment_text">COMMENT*</label>
      <textarea class="form-control" name="comment_text" rows="3"></textarea>
    </div>
      <div class="form-group col-lg-12">
          <button type="submit" name="add_comment" class="btn btn-success">POST COMMENT</button>
      </div>
    </form>
    </div>
</div>
<h5 class="card-header">Comments</h5>
<?php 

$comments = Comment::find_comments_by_profile($id); 

foreach($comments as $comment){ ?>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
      <p>User: <?php echo h($comment['full_name']); ?></p>
      <p>Comment: <?php echo h($comment['comment_text']); ?></p>
      </li>
    </ul>
<?php } ?>
</div>
</div>