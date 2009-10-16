<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_admin()){redirect_to("../session/login.php");}
	
	if(isset($_GET['id'])){
	  $match = Match::find_by_id($_GET['id']);
	} else{
	  redirect_to("index.php");
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>:: Teams ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="it"/>
    <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
    <meta name="distribution" content="Global"/>
    <link rel="shortcut icon" href="../../images/icon.ico"> 
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../../css/admin.css" media="screen"/>
  </head>
  <body>

  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" valign="middle">
  		<div id="page">
  			<div id="ctnsx">
  				<h1><a href="../index.html"><span>ADVERTBALL</span></a></h1>
  				<ul id="menu">
  					<li><a href="../agencies/index.php" class="menu_blank">Agencies</a></li>
  					<li><a href="../teams/index.php" class="menu_blank">Teams</a></li>
  					<li><a href="../matches/index.php" class="menu_blank">Matches</a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  			  <h2><?php echo $match->team1()->name ?> vs. <?php echo $match->team2()->name ?></h2>
  				<div id="scroll-container">
  					<div id="content">
					    <table class="edit_table" style="font-size:13px;">
            		<tr>
            			<td>Date</td>
            			<td class="right_column"><?php echo strftime("%D", strtotime($match->date)) ?></td>
            		</tr>
            		<tr>
            			<td>Time</td>
            			<td class="right_column"><?php echo strftime("%H:%M", strtotime($match->time)) ?></td>
            		</tr>
            		<tr><td colspan="2">&nbsp;</td></tr>
            	</table>
              
              <div style="float:left; width: 40%;">
                <table>
                  <tr>
                    <th><a href="../teams/show.php?id=<?php echo $match->team1()->id ?>"><?php echo $match->team1()->name ?></a></th>
                 	<tr>
              			<td>Goals</td>
              			<td class="right_column"><?php echo $match->team1_goals ?></td>
              		</tr>
              		<tr>
              			<td>Red Cards</td>
              			<td class="right_column"><?php echo $match->team1_reds ?></td>
              		</tr>
              		<tr>
              			<td>Yellow Cards</td>
              			<td class="right_column"><?php echo $match->team1_yellows ?></td>
              		</tr>
              	</table>
              </div>
              
              <div style="float:left; width: 40%;">
                <table>
                  <tr>
                    <th><a href="../teams/show.php?id=<?php echo $match->team2()->id ?>"><?php echo $match->team2()->name ?></a></th>
                 	<tr>
              			<td>Goals</td>
              			<td class="right_column"><?php echo $match->team2_goals ?></td>
              		</tr>
              		<tr>
              			<td>Red Cards</td>
              			<td class="right_column"><?php echo $match->team2_reds ?></td>
              		</tr>
              		<tr>
              			<td>Yellow Cards</td>
              			<td class="right_column"><?php echo $match->team2_yellows ?></td>
              		</tr>
              	</table>
              </div>
              <div style="height:20px;clear:both;"></div>
              <table width="400px">
              	<tr>
          			  <td style="text-align:left"><a href="delete.php?id=<?php echo $match->id ?>" onclick="confirm('Are you sure you want to delete this player?');"><img src="../../images/btn_cancel.gif" /></a></td>
            			<td style="text-align:left"><a href="edit.php?id=<?php echo $match->id ?>"><img src="../../images/btn_edit.gif" /></a></td>
            		  <td style="text-align:right"><a href="index.php"><img src="../../images/btn_back.gif" /></a></td>
            		</tr>
            	</table>
  						<p class="last">&nbsp;</p>
  					</div>
  				</div>
  				<div id="footer"><a href="../session/logout.php">Logout</a> &bull; <a href="../../pages/matches/show.php?id=<? echo $match->id ?>">Public Site</a></div>
  			</div>
  		</div>
  	</td>
    </tr>
  </table>
  </body>
</html>
