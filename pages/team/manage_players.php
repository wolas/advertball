<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php
  $team = Agency::find_by_id($session->agency_id)->team();

	if(isset($_POST['commit'])){
	  $player = new Player();
		$player->name = $_POST['name'];
	  $player->surname = $_POST['surname'];
	  $player->email = $_POST['email'];
	  $player->team_id = $team->id;

		if(!$player->create()){
		  $message = "Unable to insert data";
		}
		
		redirect_to("manage_players.php");
		
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Advertball - Giocatore nuovo</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="it"/>
    <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
    <meta name="description" content="Advertball - Il torneo di calcio a 7 dei profesionisti della comunicazione"/>
    <meta name="keywords" content="Y&R, Young&Rubicam Brands, VML, digital, Adidas, Birra Moretti, Fondazione Corti, ADC Group, Assocomunicazione, torneo a 7, torneo aziendale, CSI, Advertball, ball, comunicazione, calcio, agenzia di comunicazione, Actimel, Palmolive, Cisalfa Sport"/>
    <meta name="distribution" content="Global"/>
    <link rel="shortcut icon" href="../../images/icon.ico"> 
    <link rel="stylesheet" type="text/css" href="../../css/style.css" media="screen"/>
  	<script src="../../js/yav.js"></script>
    <script src="../../js/yav-config.js"></script>
      <script>
          var rules=new Array();
          rules[0]='name|required';
          rules[1]='surname|required';
          rules[2]='email|email';
          rules[3]='email|required';
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
      			  <div id="scroll-container">
      					<div id="content">
      				<h2>Players for team <?php echo $team->name ?></h2>
      				
  				    <div style="float:left; width: 40%;padding-left: 20px;">
      					<form name="_form" action="<?php echo $_SERVER['php_self']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
                	<table>
                		<tr>
                			<td>Name:</td>
                			<td><input id="name" name="name" size="20" maxlength="30" type="text" value="<?php echo $player->name;?>"/></td>
                		  <td><span id="errorsDiv_name"></span></td>
                		</tr>
                		<tr>
                			<td>Surname:</td>
                			<td><input id="surname" name="surname" size="20" maxlength="30" type="text" value="<?php echo $player->surname;?>"/></td>
                		  <td><span id="errorsDiv_surname"></span></td>
                		</tr>
                		<tr>
                			<td>Email:</td>
                			<td><input id="email" name="email" size="20" maxlength="30" type="text" value="<?php echo $player->email;?>"/></td>
                		  <td><span id="errorsDiv_email"></span></td>
                		</tr>
                		<tr>
                			<td>&nbsp;</td>
                			<td><input id="commit" name="commit" class="buttonstyle" type="submit" value="Add player" /></td>
                		</tr>
                	</table>
                </form>
              </div>
              
              <div style="float:right; width: 200px; border-left: 1px solid #171717; min-height: 100px;padding: 10px;">

  					    
  					    <?php if(count($team->players()) == 0){
  					      echo "No players";
  					    }?>
  					    <table style='font-size:.9em;width:100%'>
  					    <?php foreach ($team->players() as $player) {
                  echo "<tr>";
                  echo "<td width='150px'>" . $player->surname . ", " . $player->name . "</td>";
                  echo "<td style='text-align:right;'>";
                  echo "<a href='remove_player.php?id=" . $player->id . "' onclick='confirm('Are you sure you want to delete this player?')'>delete</a>";
                  echo " | ";
                  echo "<a href='edit_player.php?id=" . $player->id . "'>edit</a>";
                  echo "</td>";
                  echo "</tr>";
  					    }?>
  					    </table>
  					  </div>
  					  </div>
  					  </div>
  					  <div style="height:1px; clear:both;"></div>
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
<?php ob_end_flush();?>