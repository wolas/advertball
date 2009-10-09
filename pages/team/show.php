<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	
	if(isset($_GET['id'])){$team = Team::find_by_id($_GET['id']);}
	
	$same_team = false;
	if($session->is_logged_in()){$same_team = Agency::find_by_id($session->agency_id)->team() == $team;}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Squadra <?php echo $team->name ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="Content-Language" content="it"/>
  <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
  <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
  <meta name="description" content="Advertball - Il torneo di calcio a 7 dei profesionisti della comunicazione"/>
  <meta name="keywords" content="Y&R, Young&Rubicam Brands, VML, digital, Adidas, Birra Moretti, Fondazione Corti, ADC Group, Assocomunicazione, torneo a 7, torneo aziendale, CSI, Advertball, ball, comunicazione, calcio, agenzia di comunicazione, Actimel, Palmolive, Cisalfa Sport"/>
  <meta name="distribution" content="Global"/>
  <link rel="shortcut icon" href="../../images/icon.ico"> 
  <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen"/>
  <script type="text/javascript" src="../../js/scroll/prototype.js"></script>
	<script type="text/javascript" src="../../js/scroll/slider.js"></script>
	<script type="text/javascript" src="../../js/scroll/scroller.js"></script>
	<script type="text/javascript" language="javascript">
	// <![CDATA[
	$(document).observe("dom:loaded", function() {
		new Control.Scroller( 'content', 'handle', 'track', {
			up: "button-up",
			down: "button-down"
		});
	});
	// ]]>
	</script>
 </head>
  <body>

  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" valign="middle">
  		<div id="page">
  			<div id="ctnsx">
  				<h1><a href="../index.html"><span>ADVERTBALL</span></a></h1>
  				<ul id="menu">
  					<li><a href="../about.html" class="menu1"><span>Che cos'&egrave; Advertball</span></a></li>
  					<li><a href="../rules.html" class="menu2"><span>Regolamento</span></a></li>
  					<li><a href="index.php" class="menu3on"><span>Squadre</span></a></li>
  					<li><a href="../programme.html" class="menu4"><span>Programma</span></a></li>
  					<li><a href="../sponsors.html" class="menu6"><span>Spondor</span></a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  			  <h2><img src="../../images/squadra.gif" /></h2>
  				<div id="scroll-container">
  					<div id="content">
  					  <h2 style="padding-left: 22px"><?php echo $team->name ?></h2>
  					  
  					  <div style="float:left; width:242px; padding-left: 22px;">
                <img src="../../uploads/<?php echo $team->logo;?>" width="200px"/>
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
              		<?php if($same_team){?>
              		<tr>
              			<td style="text-align:left"><a href="manage_players.php"><img src="../../images/btn_manage_players.gif" /></a></td>
              			<td style="text-align:left"><a href="edit.php"><img src="../../images/btn_edit.gif" /></a></td>
              		</tr>
              		<tr>
              			<td>&nbsp;</td>
              			<td style="text-align:left"><?php if($same_team){?><a href="edit_logo.php"><img src="../../images/btn_edit_logo.gif" /></a><?php }?></td>
              		</tr>
              		<?php }?>
              	</table>
              </div>
						  <div style="height:1px; clear:both;"></div>
  						<p class="last">&nbsp;</p>
  					</div>
  				</div>
  				<div id="footer">
  			    <?php if($session->is_logged_in()){?><a href="logout.php">Logout</a> &bull; <?php }else{?><a href="login.php">Login</a> &bull; <?php }?>
    			  <a href="../faq.html">Faq</a> &bull; <a href="../contact.html">Contatti</a>
  			  </div>
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
