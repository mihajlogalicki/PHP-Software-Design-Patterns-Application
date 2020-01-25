<?php require('../private/initialize.php');

if(is_post_request()){

    $img_name = $_FILES['profile_image']['name'];
    $img_tmp = $_FILES['profile_image']['tmp_name'];
 
    $target_directory = "../private/uploads";
    move_uploaded_file($img_tmp, "$target_directory/$img_name");

    $args = [];
    $args['description'] = $_POST['description'];
    $args['profile_image'] = $img_name;
    $args['price_per_hour'] = $_POST['price_per_hour'];
    $args['type'] = $_POST['type'];

    $user = new User($args);

    if(validation_profile_image($img_name) && 
      !is_blank($args['description']) && 
      !is_blank($args['price_per_hour'])){
        $user->create();
        redirect_to('read_admin.php');
    }
}

?>
<h2>Add Profile</h2>
<form method="POST" enctype="multipart/form-data" action="create_admin.php">
    <div class="form-group col-lg-7">
        <label for="description">Description</label>
        <textarea rows="4" cols="50" class="form-control"  name="description"></textarea>
    </div>
    <div class="form-group col-lg-2">
        <label for="price_per_hour">Price per hour</label>
        $<input type="text" class="form-control" name="price_per_hour" id="price_per_hour">
    </div>
    <div class="form-group col-lg-2">
    <label for="type">Type of copywriter</label>
    <select class="form-control" name="type">
      <option>select a type</option>
      <?php foreach(User::TYPES as $type) { ?>
         <option value="<?php echo $type ?>"><?php echo $type; ?></option>
      <?php } ?>
    </select>
  </div>
    <div class="form-group col-lg-7">
        <label for="profile_image">Profile Image</label>
        <input type="file" class="form-control-file" name="profile_image" id="profile_image">
    </div>
    <div class="form-group col-lg-7">
    <button type="submit" name="submit" class="btn btn-primary">Save New Profile</button>
    </div>
</form>