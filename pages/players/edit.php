<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_logged_in()){redirect_to("login.php");}

  $player = Player::find_by_id($_GET['id']);
  $team = $player->team();

	if(isset($_POST['commit'])){
	  $player->name = $_POST['name'];
	  $player->surname = $_POST['surname'];
	  $player->number = $_POST['number'];
	  $player->email = $_POST['email'];
		
		if(!$player->save()){$message = "Unable to insert data";}
		
		if($_FILES['userfile']["name"][0] || $_FILES['userfile']["name"][1]){
  		/* upload files only when player is valid */
  		$files = array();
  		$upload_dir = SITE_ROOT . DS . "uploads" . DS . "team_" . $team->id . DS;
	    
  		while(list($key,$value) = each($_FILES['userfile']['name'])){
  			if(!empty($value)){
  			  $extension = substr($value, strrpos($value, '.'));
  				$filename = "player_" . $player->id . "_" . $key . $extension;
  				$files[$key]	= $filename;
  				$filename = $upload_dir . str_replace(" ","_",$filename);// replace blank space with '_'
  				move_uploaded_file($_FILES['userfile']['tmp_name'][$key],$filename);
  			}
  		}
  		

  		//add file name to player fields
  		if($files[0]){$player->photo = $files[0];}
  		if($files[1]){$player->payslip = $files[1];}
  		$player->save(); // because we modified it
		}
		
		redirect_to("manage.php?id=" . $team->id);	
	}
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
      			  <h2><img src="../../images/edit_player.gif" /></h2>
              <div id="scroll-container">
      					<div id="content">
        					<form name="_form" action="<?php echo $_SERVER['php_self']?>" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');" enctype='multipart/form-data'>
                  	<table class="edit_table"> 
                  		<tr>
                  			<td>Name</td>
                  			<td><input id="name" name="name" size="15" maxlength="30" type="text" value="<?php echo $player->name;?>"/></td>
                  		</tr>
                  		<tr>
                  			<td>Surname</td>
                  			<td><input id="surname" name="surname" size="15" maxlength="30" type="text" value="<?php echo $player->surname;?>"/></td>
                  		</tr>
                  		<tr>
                  			<td>Number</td>
                  			<td><input id="number" name="number" size="15" maxlength="30" type="text" value="<?php echo $player->number;?>"/></td>
                  		</tr>
                  		<tr>
                  			<td>Email</td>
                  			<td ><input id="email" name="email" size="15" maxlength="30" type="text" value="<?php echo $player->email;?>"/></td>
                  		</tr>
                  		<tr><td colspan="2">&nbsp;</td></tr>
                  		<tr>
                  			<td>Photo</td>
                  			<td><input id="photo" type="file" size="33" name="userfile[]"></td>
                  		</tr>
      					      <tr>
                  			<td>Busta</td>
                  			<td><input id="payslip" type="file" size="33" name="userfile[]"></td>
                  		</tr>
                  		<tr><td colspan="2">&nbsp;</td></tr>
                  		<tr>
                  			<td style="text-align:left;"><a href="show.php?id=<?php echo $player->id?>"><img src="../../images/btn_back.gif" alt="indietro" /></a></td>
                  			<td><input id="commit" name="commit" class="send" type="submit" value="" /></td>
                  		</tr>
                  	</table>
                  </form>
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
<?php ob_end_flush();?>