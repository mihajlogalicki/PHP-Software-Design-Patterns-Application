<?php require('../private/initialize.php');

$session->require_login();

$id = $_GET['id'] ?? false;

$user = User::find_by_id($id);

if(is_post_request()){
  
    $args = [];
    $args['description'] = $_POST['description'];
    $args['price_per_hour'] = $_POST['price_per_hour'];
    $args['type'] = $_POST['type'];

    $user = new User($args);
    
    if(!is_blank($args['description']) && !is_blank($args['price_per_hour'])){
        $user->update($id);
        redirect_to('read_admin.php');
   } else { 
        redirect_to("update_admin.php?id=" . $id);
   }

} 

?>
<h2>Edit Profile</h2>
<form method="POST" enctype="multipart/form-data" action="<?php echo url_to('update_admin.php?id='.$id); ?>">
    <div class="form-group col-lg-7">
        <label for="description">Description</label>
        <textarea rows="4" cols="50" class="form-control"  name="description"><?php echo h($user['description']); ?></textarea>
    </div>
    <div class="form-group col-lg-2">
        <label for="price_per_hour">Price per hour</label>
        $<input type="text" class="form-control" name="price_per_hour" value="<?php echo h($user['price_per_hour']) ?>">
    </div>
    <div class="form-group col-lg-2">
    <select class="form-control" name="type">
      <option value=""></option>
    <?php foreach(User::TYPES as $type) { ?>
      <option value="<?php echo $type; ?>"<?php if($user['type'] == $type) {echo 'selected';} ?>>
        <?php echo $type; ?>
      </option>
    <?php } ?>
    </select>
      </div> 
      <div class="form-group col-lg-2"> 
    <button type="submit" name="submit" class="btn btn-primary">Update New Profile</button>
    </div>
</form>