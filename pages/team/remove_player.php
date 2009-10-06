<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php
  $team = Agency::find_by_id($session->agency_id)->team();
  $player = Player::find_by_id($_GET['id']);
  
  $player_in_team = in_array($player, $team->players());
  if($player_in_team){
    $player->delete();
  }
  redirect_to("manage_players.php");
?>