<?php 
	ob_start();
	require_once("../../includes/initialize.php");
  if(!$session->is_admin()){redirect_to("../session/login.php");}
  
  $match = Match::find_by_id($_GET['id']);
  $match->delete();
  redirect_to("index.php");
?>