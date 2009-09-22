<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("../login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("No photograph ID was provided.");
    redirect_to('index.php');
  }

  $agency = Agency::find_by_id($_GET['id']);
  if( $agency &&  $agency->delete()) {
    $session->message("Unable to delete file.");
    redirect_to('index.php');
  	} else {
    $session->message("The unable to deleted record.");
    redirect_to('index.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>