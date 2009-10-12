<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	$player = Player::find_by_id($_GET['id']);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Squadra <?php echo $player->name ?></title>
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
  					<li><a href="../register.php" class="menu3"><span>Preiscrizione</span></a></li>
  					<li><a href="../programme.html" class="menu4"><span>Programma</span></a></li>
  					<li><a href="../sponsors.html" class="menu6"><span>Spondor</span></a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  				<h2>Team</h2>
  				<div id="scroll-container">
  					<div id="track"><div id="handle"></div></div>
  					<div id="button-up"></div>
  					<div id="button-down"></div>
  					<div id="content">
						  
						  <table>
            		<tr>
            			<td>Name:</td>
            			<td><?php echo $player->name;?></td>
            		</tr>
            		<tr>
            			<td>Surname</td>
            			<td><?php echo $player->surname;?></td>
            		</tr>
            	</table>
						  
  						<p class="last">&nbsp;</p>
  					</div>
  				</div>
  				<div id="footer"><a href="#1">Faq</a> &bull; <a href="contact.html">Contatti</a></div>
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
