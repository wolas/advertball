<?php
  ob_start();
	require_once("../includes/initialize.php");
	if(!$session->is_admin()){redirect_to("session/login.php");}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Advertball - Edit player</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="it"/>
    <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
    <meta name="description" content="Advertball - Il torneo di calcio a 7 dei profesionisti della comunicazione"/>
    <meta name="keywords" content="Y&R, Young&Rubicam Brands, VML, digital, Adidas, Birra Moretti, Fondazione Corti, ADC Group, Assocomunicazione, torneo a 7, torneo aziendale, CSI, Advertball, ball, comunicazione, calcio, agenzia di comunicazione, Actimel, Palmolive, Cisalfa Sport"/>
    <meta name="distribution" content="Global"/>
    <link rel="shortcut icon" href="../images/icon.ico"> 
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen"/>
    <link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen"/>
  </head>
  <body>
    <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" valign="middle">
    		  <div id="page">
      			<div id="ctnsx">
      				<h1><a href="index.php"><span>ADVERTBALL</span></a></h1>
      				<ul id="menu">
      					<li><a href="agencies/index.php" class="menu_blank">Agencies</a></li>
      					<li><a href="teams/index.php" class="menu_blank">Teams</a></li>
      					<li><a href="matches/index.php" class="menu_blank">Matches</a></li>
      				</ul>
      			</div>
      			<div id="ctndx">
      			  <h2><img src="../images/edit_player.gif" /></h2>
              <div id="scroll-container">
      					<div id="content">
      				    <h2>TITLE</h2>
  				        
  				        <?php //print_r($session); ?>
  				
                </div>
              </div>
  					  <div id="footer"><a href="session/logout.php">Logout</a></div>
			      </div>
			    </div>			    
    	  </td>
      </tr>
    </table>
  </body>
</html>
<?php ob_end_flush();?>