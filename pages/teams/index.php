<?php
	require_once("../../includes/initialize.php");
	$teams = Team::find_all();
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Squadre</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="Content-Language" content="it"/>
  <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
  <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
  <meta name="description" content="Advertball - Il torneo di calcio a 7 dei profesionisti della comunicazione"/>
  <meta name="keywords" content="Y&R, Young&Rubicam Brands, VML, digital, Adidas, Birra Moretti, Fondazione Corti, ADC Group, Assocomunicazione, torneo a 7, torneo aziendale, CSI, Advertball, ball, comunicazione, calcio, agenzia di comunicazione, Actimel, Palmolive, Cisalfa Sport"/>
  <meta name="distribution" content="Global"/>
  <link rel="shortcut icon" href="../../images/icon.ico"> 
  <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen"/>
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
      					<li><a href="../static/programme.html" class="menu4"><span>Programma</span></a></li>
      					<li><a href="../teams/index.php" class="menu3on"><span>Squadre</span></a></li>
      					<li><a href="../matches/index.php" class="menu8"><span>Partite</span></a></li>
      					<li><a href="../static/rules.html" class="menu2"><span>Regolamento</span></a></li>
      					<li><a href="../static/prizes.html" class="menu5"><span>Premi</span></a></li>
      					<li><a href="../register/index.html" class="menu7"><span>Iscrizione</span></a></li>
      					<li><a href="../static/sponsors.html" class="menu6"><span>Credits</span></a></li>
      				</ul>
      			</div>
      			<div id="ctndx">
    		      <h2><img src="../../images/squadre.gif" /></h2>
      				<div id="scroll-container">
      					<div id="content">
        		      <?php foreach($teams as $team){ ?>
        		        <div style="background-color:#ffffff;float:left;width:120px;height:120px;margin:10px;">
        		          <a href="show.php?id=<?php echo $team->id?>"><img src="../../uploads/<?php echo $team->logo_url(); ?>" title="<?php echo $team->name ?>" style="width:100px;height:100px;padding:10px 0 0 10px;"/></a>
        		        </div>
        		      <?php }?>
      			    </div>
      			  </div>
      			  <div id="footer">
      			    <?php if($session->is_logged_in()){?><a href="../session/logout.php">Logout</a> &bull; <?php }else{?><a href="../session/login.php">Login</a> &bull; <?php }?>
        			  <a href="../static/faq.html">Faq</a> &bull; <a href="../static/contact.html">Contatti</a>
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
<?php if(isset($database)) { $database->close_connection(); } ?>