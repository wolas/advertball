<?php 
ob_start();
require_once("../../includes/initialize.php");
if(!$session->is_admin()){redirect_to("../session/login.php");}

$match = Match::find_by_id($_GET['id']);
$match->published = ($_GET['published'] == "false") ? false : true;
$match->save();

//send emails

redirect_to("index.php");

?>