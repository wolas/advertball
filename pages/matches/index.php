<?php
  ob_start();
	require_once("../../includes/initialize.php");
	
	$matches = Match::find_all();
	print_r($matches);
	$matches = usort($matches, function($a, $b){return $a->date > $b->date ? 1 : -1;} );
	print_r($matches);
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Matches</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="Content-Language" content="it"/>
  <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
  <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
  <meta name="description" content="Advertball - Il torneo di calcio a 7 dei profesionisti della comunicazione"/>
  <meta name="keywords" content="Y&R, Young&Rubicam Brands, VML, digital, Adidas, Birra Moretti, Fondazione Corti, ADC Group, Assocomunicazione, torneo a 7, torneo aziendale, CSI, Advertball, ball, comunicazione, calcio, agenzia di comunicazione, Actimel, Palmolive, Cisalfa Sport"/>
  <meta name="distribution" content="Global"/>
  <link rel="shortcut icon" href="../../images/icon.ico"> 
  <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen"/>
  <script type="text/javascript" src="../../js/tab.js"></script>
  <script type="text/javascript" src="../../js/scroll/prototype.js"></script>
	<script type="text/javascript" src="../../js/scroll/slider.js"></script>
	<script type="text/javascript" src="../../js/scroll/scroller.js"></script>
	<script type="text/javascript" language="javascript">
  	// <![CDATA[
  	$(document).observe("dom:loaded", function() {
  		new Control.Scroller( 'content', 'handle', 'track', {up: "button-up",down: "button-down"});});
  	$(document).observe("dom:loaded", function() {
  		new Control.Scroller( 'content2', 'handle2', 'track2', {up: "button-up",down: "button-down"});});
  	// ]]>
	</script>
 </head>
  <body>

  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" valign="middle">
  		<div id="page">
  			<div id="ctnsx">
  				<h1><a href="../../index.html"><span>ADVERTBALL</span></a></h1>
  				<ul id="menu">
  					<li><a href="../static/about.html" class="menu1"><span>Che cos'&egrave; Advertball</span></a></li>
  					<li><a href="../static/rules.html" class="menu2"><span>Regolamento</span></a></li>
  					<li><a href="../teams/index.php" class="menu3"><span>Squadre</span></a></li>
  					<li><a href="../static/programme.html" class="menu4"><span>Programma</span></a></li>
  					<li><a href="../static/sponsors.html" class="menu6"><span>Spondor</span></a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  				<h2 class="sx"><img src="../../images/regolamento.gif" alt="regolamento" /></h2>
  				<ul id="menutab">
  					<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
  					<li><a href="#1" class="off" id="tab2" onclick="showTab2();showBox('2');hideBox('1');"><span>Tecnico</span></a></li>
  					<li><a href="#1" class="on" id="tab1" onclick="showTab1();showBox('1');hideBox('2');"><span>Generale</span></a></li>
  				</ul>
  				<img class="regolamento sx" src="../../images/riga_regolamento.gif" alt="" />
  				<div id="ctntab">
  					<div class="texttab" id="texttab1">
  						<div id="scroll-container">
  							<div id="track"><div id="handle"></div></div>
  							<div id="button-up"></div>
  							<div id="button-down"></div>
  							<div id="content">
  							  <?php foreach($matches as $match){ ?>
  							    
  							  <?php } ?>
  								<p class="last">&nbsp;</p>
  							</div>
  						</div>								
  					</div>
  					<div class="texttab" id="texttab2">
  						<div id="scroll-container2">
  							<div id="track2"><div id="handle2"></div></div>
  							<div id="button-up2"></div>
  							<div id="button-down2"></div>
  							<div id="content2">
  							  Bar
  								<p class="last">&nbsp;</p>
  							</div>
  						</div>
  					</div>
  				</div>
  				<div id="footer"><a href="faq.html">Faq</a> &bull; <a href="contact.html">Contatti</a></div>
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

<?php ob_end_flush();?>