<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	
	if(isset($_GET['id'])){
	  $team = Team::find_by_id($_GET['id']);
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
  					<li><a href="../dashboard.php" class="menu_blank">Dashboard</a></li>
  					<li><a href="../agencies/index.php" class="menu_blank">Agencies</a></li>
  					<li><a href="index.php" class="menu_blank">Teams</a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  			  <h2><img src="../../images/squadre.gif" /></h2>
  				<div id="scroll-container">
  					<div id="content">
  					  <h2 style="padding-left: 22px"><?php echo $team->name ?></h2>
  					  
  					  <div style="float:left; width:242px; padding-left: 22px;">
                <img src="../../uploads/<?php echo $team->logo_url(); ?>" width="200px"/>
              </div>
  					  <div style="float:left;">
						    <table class="edit_table">
              		<tr>
              			<td>Colour 1</td>
              			<td class="right_column"><?php echo $team->colour1;?></td>
              		</tr>
              		<tr>
              			<td>Colour 2</td>
              			<td class="right_column"><?php echo $team->colour2;?></td>
              		</tr>
              		<tr><td colspan="2">&nbsp;</td></tr>
              		<tr>
              			<td>Coach Name</td>
              			<td class="right_column"><?php echo $team->coach_name;?></td>
              		</tr>	
              		<tr>
              			<td>Coach Email</td>
              			<td class="right_column"><?php echo $team->coach_email;?></td>
              		</tr>
              		<tr>
              			<td>Contact Telephone</td>
              			<td class="right_column"><?php echo $team->coach_telephone;?></td>
              		</tr>
              		<tr><td colspan="2">&nbsp;</td></tr>
              		<tr>
              			<td>Assistant Coach</td>
              			<td class="right_column"><?php echo $team->assistant_name;?></td>
              		</tr>	
              		<tr>
              			<td>Assistant Email</td>
              			<td class="right_column"><?php echo $team->assistant_email;?></td>
              		</tr>
              		<tr>
              			<td>Assistant Telephone</td>
              			<td class="right_column"><?php echo $team->assistant_telephone;?></td>
              		</tr>
              		<tr><td colspan="2">&nbsp;</td></tr>
              			<tr>
                			<td style="text-align:left"><a href="../players/manage.php?id=<?php echo $team->id ?>"><img src="../../images/btn_manage_players.gif" /></a></td>
                			<td style="text-align:left"><a href="edit.php?id=<?php echo $team->id ?>"><img src="../../images/btn_edit.gif" /></a></td>
                		</tr>
              	</table>
              </div>
						  <div style="height:1px; clear:both;"></div>
  						<p class="last">&nbsp;</p>
  					</div>
  				</div>
  				<div id="footer"><a href="logout.php">Logout</a></div>
  			</div>
  		</div>
  	</td>
    </tr>
  </table>
  <script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
    try {
    var pageTracker = _gat._getTracker("UA-7408828-12");
    pageTracker._trackPageview();
    } catch(err) {}
  </script>

  </body>
</html>
