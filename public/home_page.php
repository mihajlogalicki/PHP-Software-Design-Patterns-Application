<?php require_once('../private/initialize.php'); ?>

<div id="main">
  <ul id="menu">
    <!-- <li><a href="<?php echo url_to('user.php') ?>">View Your User Profiles</a></li> -->
  </ul>
</div>
<?php

$users = User::find_all();

?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?php if($session->is_logged_in()) { ?>
          <p><a class="navbar-brand" href="<?php echo url_to('create_admin.php') ?>">Add Profile</a></p>
          <p><a class="navbar-brand" href="<?php echo url_to('read_admin.php') ?>">&nbsp CMS</a></p>
          <p><a class="navbar-brand" href="<?php echo url_to('logout.php') ?>">&nbsp Logout</a></p>
     <?php } ?>
    </nav>
    <div class="container">
    <h2 class="text-center">Copywriters (Profiles)</h2><br>
    <div class="row">
  <?php foreach($users as $user) { ?>
  
<div class="col-sm-6">
    <div class="card">
    <h5 class="card-header"><?php echo $user['type'] ?></h5>
      <div class="card-body">
        <h5 class="card-title">
        <img style="width: 280px;height: 250px;" src="../private/uploads/<?php echo $user['image'] ?>">
        </h5>
        <p class="card-text">
            <p class="card-text"><?php echo substr($user['description'], 0, 200); ?>....</p>
            <h5 class="card-title"><?php echo h(money_format('$%i', $user['price_per_hour'])); ?> per hour</h5>
        </p>
        <a href="detail.php?id=<?php echo h($user['id']); ?>" class="btn btn-primary">See More</a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
  



