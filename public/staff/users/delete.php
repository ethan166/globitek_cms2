<?php
require_once('../../../private/initialize.php');

$errors = array();
if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$users_result = find_user_by_id($_GET['id']);
// No loop, only one result
$user = db_fetch_assoc($users_result);

if(is_post_request()) {
  if(isset($_POST['yes'])) {
      $result = delete_user($user);
      if($result === true) {
        redirect_to('index.php');
      } else {
        $errors = $result;
      }
  }
  if(isset($_POST['no'])) { redirect_to('index.php'); }
}



//
?>
<?php $page_title = 'Staff: Delete User ' . $user['first_name'] . " " . $user['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Users List</a><br />

  <h1>Delete User: <?php echo $user['first_name'] . " " . $user['last_name']; ?></h1>

  <?php echo display_errors($errors); ?>

  <form action="#" method="post">

    Are you sure you want to permanently delete the user:<br />
    <input type="submit" name="yes" value="Yes"  />
    <input type="submit" name="no" value="No" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
