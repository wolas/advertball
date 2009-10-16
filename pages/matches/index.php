<?php
  ob_start();
	require_once("../../includes/initialize.php");
	$matches = Match::find_by_sql("SELECT * FROM matches ORDER BY date ASC");
	$teams = Team::find_all();

	function sort_points($a, $b) {
      if ($a->points() == $b->points()){return 0;}
      return ($a->points() > $b->points()) ? -1 : 1;
  }

  usort($teams, 'sort_points');
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
  				<ul id="menutab2">
  					<li><a href="#1" class="off" id="tab3" onclick="showTab3();showBox('3');hideBox('4', '5');"><span>Resultati</span></a></li>
  					<li><a href="#1" class="off" id="tab4" onclick="showTab4();showBox('4');hideBox('3', '5');"><span>Generale</span></a></li>
  					<li><a href="#1" class="on" id="tab5" onclick="showTab5();showBox('5');hideBox('3', '4');"><span>Generale</span></a></li>
  				</ul>
  				<img class="regolamento sx" src="../../images/riga_regolamento_2.gif" alt="" />
  				<div id="ctntab">
  					<div class="texttab" id="texttab3">
  						<div id="scroll-container-small">
  							<div id="track"><div id="handle"></div></div>
  							<div id="button-up"></div>
  							<div id="button-down"></div>
  							<div id="content">
  							  <table cellspacing="0" cellpadding="0" style="border-left: 1px solid #877c0c; border-bottom: 1px solid #877c0c; ">
  							    <?php $index = 0 ?>
  							    <?php foreach($matches as $match){ ?>
  							      
  							      <?php if(strtotime($day) != strtotime($match->date)){?>
  							      <tr><th colspan="4" style="padding-left: 20px;text-align:left;height:30px;background-color:#877c0c; font-size:14px;" ><?php echo strftime("%A %d %B %Y", strtotime($match->date)) ?></th></tr>
  							      <?php $day = $match->date ?>
  							      <?php } ?>
  							      <?php 
  							        $index +=1;  
  							        $style = "border-right:1px solid #877c0c; color:#3f250e; font-size:14px; font-weight:bold; height:35px; padding:5px 10px 5px 10px;"
  							      ?>
  							    <tr>
  							      <?php ($index % 2) ? $style = "$style background-color:#c1bfa8" : $style = "$style background-color:#ebe9d5"; ?>
  							      <td style="text-align: center; width:90px; <?php echo $style?>"><?php echo strftime("%Hh%m", strtotime($match->time))?></td>
  							      <td style="text-align: right; width:220px; <?php echo $style?>"><?php echo $match->team1()->name ?></td>
  							      <td style="text-align: center; width:75px; <?php echo $style?>">
  							        <?php echo $match->team1_goals ?>
  							        -
  							        <?php echo $match->team2_goals ?>
  							      </td>
  							      <td style="text-align: left; width:220px; <?php echo $style?>"><?php echo $match->team2()->name ?></td>
  							    </tr>
  							    <?php } ?>
  							  </table>
  								<p class="last">&nbsp;</p>
  							</div>
  						</div>								
  					</div>
  					
  					<div class="texttab" id="texttab4">
  						<div id="scroll-container-small">
  							<div id="track2"><div id="handle2"></div></div>
  							<div id="button-up2"></div>
  							<div id="button-down2"></div>
  							<div id="content2">
  							  <table cellspacing="0" cellpadding="0" style="border-left: 1px solid #877c0c; border-bottom: 1px solid #877c0c; ">
  							    <tr>
  							      <?php $style = "style=\"height:40px;background-color:#877c0c; font-size:16px;\""?>
  							      <th <?php echo $style ?> >Agenzia</th>
  							      <th <?php echo $style ?> >Goals</th>
  							      <th <?php echo $style ?> >Matches</th>
  							      <th <?php echo $style ?> >Goals/Match</th>
  							      <th <?php echo $style ?> >Reds</th>
  							      <th <?php echo $style ?> >Yellows</th>
  							    </tr>
  							    <?php $index = 0 ?>
  							    <?php foreach($teams as $team){ ?>
  							      <?php 
  							        $index +=1;  
  							        $style = "border-right:1px solid #877c0c; color:#3f250e; font-size:14px; font-weight:bold; height:40px; padding:5px 10px 5px 10px;"
  							      ?>
  							    <tr>
  							      <?php ($index % 2) ? $style = "$style background-color:#c1bfa8" : $style = "$style background-color:#ebe9d5"; ?>
  							      <td style="text-align: left; width:220px; <?php echo $style?>"><a href="../teams/show.php?id=<?php echo $team->id ?>"><?php echo $team->name?><a/></td>
  							      <td style="text-align: center; width:75px; <?php echo $style?>"><?php echo $team->goals() ?></td>
  							      <td style="text-align: center; width:75px; <?php echo $style?>"><?php echo count($team->matches()) ?></td>
  							      <td style="text-align: center; width:75px; <?php echo $style?>"><?php echo $team->goals() / count($team->matches()) ?></td>
  							      <td style="text-align: center; width:75px; <?php echo $style?>"><?php echo $team->reds() ?></td>
  							      <td style="text-align: center; width:75px; <?php echo $style?>"><?php echo $team->yellows() ?></td>
  							    </tr>
  							    <?php } ?>
  							  </table>
  								<p class="last">&nbsp;</p>
  							</div>
  						</div>
  					</div>
  					
  					<div class="texttab" id="texttab5">
  						<div id="scroll-container-small">
  							<div id="track3"><div id="handle3"></div></div>
  							<div id="button-up3"></div>
  							<div id="button-down3"></div>
  							<div id="content3">
  							  <table cellspacing="0" cellpadding="0" style="border-left: 1px solid #877c0c; border-bottom: 1px solid #877c0c; ">
  							    <tr>
  							      <?php $style = "style=\"height:40px;background-color:#877c0c; font-size:16px;\""?>
  							      <th <?php echo $style ?> >Rank</th>
  							      <th <?php echo $style ?> >Agenzia</th>
  							      <th <?php echo $style ?> >Points</th>
  							      <th <?php echo $style ?> >Played</th>
  							      <th <?php echo $style ?> >Wins</th>
  							      <th <?php echo $style ?> >Loss</th>
  							      <th <?php echo $style ?> >Draw</th>
  							    </tr>
  							    <?php $index = 0 ?>
  							    <?php foreach($teams as $team){ ?>
  							      <?php 
  							        $index +=1;  
  							        $style = "border-right:1px solid #877c0c; color:#3f250e; font-size:14px; font-weight:bold; height:40px; padding:5px 10px 5px 10px;"
  							      ?>
  							    <tr>
  							      <?php ($index % 2) ? $style = "$style background-color:#c1bfa8" : $style = "$style background-color:#ebe9d5"; ?>
  							      <td style="text-align: center; width:40px; <?php echo $style?>"><?php echo $index ?></td>
  							      <td style="text-align: center; width:220px; <?php echo $style?>"><a href="../teams/show.php?id=<?php echo $team->id ?>"><?php echo $team->name?><a/></td>
  							        <td style="text-align: center; width:50px; <?php echo $style?>"><?php echo $team->points() ?></td>
  							      <td style="text-align: center; width:50px; <?php echo $style?>"><?php echo count($team->matches()) ?></td>
  							      <td style="text-align: center; width:50px; <?php echo $style?>"><?php echo count($team->matches_won()) ?></td>
  							      <td style="text-align: center; width:50px; <?php echo $style?>"><?php echo count($team->matches_lost()) ?></td>
  							      <td style="text-align: center; width:50px; <?php echo $style?>"><?php echo count($team->matches_draw()) ?></td>
  							    </tr>
  							    <?php } ?>
  							  </table>
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