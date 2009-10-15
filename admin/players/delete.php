<?php 
	ob_start();
	require_once("../../includes/initialize.php");
  
  $player = Player::find_by_id($_GET['id']);
  $team = $player->team();
  $player->delete();
  redirect_to("manage.php?id=" . $team->id );
?>