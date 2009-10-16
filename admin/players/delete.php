<?php 
	ob_start();
	require_once("../../includes/initialize.php");
  if(!$session->is_admin()){redirect_to("../session/login.php");}
  
  $player = Player::find_by_id($_GET['id']);
  $team = $player->team();
  $player->delete();
  redirect_to("manage.php?id=" . $team->id );
?>