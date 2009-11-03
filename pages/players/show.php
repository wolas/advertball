<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	
	if(isset($_GET['id'])){
	  $player = Player::find_by_id($_GET['id']);
	  $team = $player->team();
	  $same_team = false;
  	if($session->is_logged_in()){$same_team = (Agency::find_by_id($session->agency_id)->team() == $team);}
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
  			  <h2><img src="../../images/player.gif" alt="giocatore"/></h2>
  				<div id="scroll-container">
  					<div id="content">
  					  <h2><?php echo $player->full_name() ?></h2>
  					  <div style="float:left; width:242px; padding-left: 22px;">
                <img src="../../uploads/<?php echo $player->photo_url(); ?>" width="200px"/>
              </div>
  					  <div style="float:left;">
						    <table class="edit_table">
              		<tr>
              			<td>Team</td>
              			<td class="right_column"><a href="../teams/show.php?id=<?php echo $team->id ?>"><?php echo $player->team()->name ?></a></td>
              		</tr>
              		<tr>
              			<td>Number</td>
              			<td class="right_column"><?php echo $player->number ?></td>
              		</tr>
              		<?php if($same_team){ ?>
              		<tr>
              			<td>Email</td>
              			<td class="right_column"><a href="mailto:<?php echo $player->email ?>"><?php echo $player->email ?></a></td>
              		</tr>
              		<tr>
              			<td>Busta Paga</td>
              			<td class="right_column"><a href="../../uploads/<?php echo $player->payslip_url() ?>">Download</a></td>
              		</tr>
              		<tr><td colspan="2">&nbsp;</td></tr>
              		<tr>
            			  <td style="text-align:left"><a href="delete.php?id=<?php echo $player->id ?>" onclick="return confirm('Are you sure you want to delete this player?');"><img src="../../images/btn_cancel.gif" /></a></td>
              			<td style="text-align:right"><a href="edit.php?id=<?php echo $player->id ?>"><img src="../../images/btn_edit.gif" /></a></td>
              		</tr>
              		<?php } ?>
              		<tr>
          			    <td>&nbsp;</td>
              			<td style="text-align:right"><a href="manage.php?id=<?php echo $team->id ?>"><img src="../../images/btn_back.gif" /></a></td>
              		</tr>
              	</table>
              </div>
						  <div style="height:1px; clear:both;"></div>
  						<p class="last">&nbsp;</p>
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
