<?php
require_once('../../../private/initialize.php');


/*
if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$id = $_GET['id'];
$salespeople_result = find_salesperson_by_id($id);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);
*/
$errors = array();
$territory = array(
  'name' => '',
  'position' => '',
  'state_id' => ''
);

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}

if(is_post_request()) {

  // Confirm that values are present before accessing them.
  if(isset($_POST['name'])) { $territory['name'] = $_POST['name']; }
  if(isset($_POST['position'])) { $territory['position'] = $_POST['position']; }
  if(isset($_GET['id'])) { $territory['state_id'] = $_GET['id']; }

  $result = insert_territory($territory);
  if($result === true) {
    $new_id = db_insert_id($db);
    redirect_to('show.php?id=' . $new_id);
  } else {
    $errors = $result;
  }
}

?>
<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../states/index.php">Back to State Details</a><br />

  <h1>New Territory</h1>

  <!-- TODO add form -->
  <?php echo display_errors($errors); ?>

  <form action="##" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo $territory['name']; ?>" /><br />
    Position:<br />
    <input type="text" name="position" value="<?php echo $territory['position']; ?>" /><br />
    <input type="submit" name="submit" value="Create"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
