<?php 
	ob_start();
	require_once("../../includes/initialize.php");
  
  $team = Team::find_by_id($_GET['id']);
  if($session->is_logged_in()){$same_team = (Agency::find_by_id($session->agency_id)->team() == $team);}
  
  if(isset($_POST['commit'])){
	  $player = new Player();
	  $player->name = $_POST['name'];
	  $player->surname = $_POST['surname'];
	  $player->email = $_POST['email'];
	  $player->team_id = $team->id;

		if(!$player->save()){
		  $message = "Unable to insert data";
		}

		/* upload files only when player is valid */
		$_files;
		$upload_dir = SITE_ROOT . DS . "uploads" . DS . "team_" . $team->id . DS;
		mkdir($upload_dir);

		while(list($key,$value) = each($_FILES['userfile']['name'])){
			if(!empty($value)){
			  $extension = substr($value, strrpos($value, '.') + 1);
				$filename = "player_" . $player->id . "_" . $key . "." . $extension;
				$_files .=	str_replace(" ","_",$filename) . ":";			
				$filename= $upload_dir . str_replace(" ","_",$filename);// replace blank space with '_'
				move_uploaded_file($_FILES['userfile']['tmp_name'][$key],$filename);
			}
		}
		//retrieve file uploaded file names
		list($_photo, $_payslip) = explode(":", $_files);

		//add file name to player fields
		$player->photo = $_photo;
		$player->payslip = $_payslip;
		$player->save(); // because we modified it

		redirect_to("manage.php?id=$team->id");
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
    
      function check_photo() {
        var msg;
        (document.forms[0].photo.value == "" ) ? msg = "Photo is required" : msg = null;
      	return msg;
      }
      
      function check_payslip() {
        var msg;
        (document.forms[0].payslip.value == "" ) ? msg = "Payslip is required" : msg = null;
      	return msg;
      }

      var rules=new Array();
      rules[0]='name|required';
      rules[1]='surname|required';
      rules[2]='email|email';
      rules[3]='email|required';
      rules[4]='payslip|required';
      rules[5]='photo|custom|check_photo()';
      rules[6]='payslip|custom|check_payslip()';
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
      			  <h2><img src="../../images/players.gif" alt="Modifica Squadra" /></h2>
      			  <div id="scroll-container">
      					<div id="content">
      					  <h3><?php echo $message ?></h3>
      				    
      				    <?php if((count($team->players()) != 15) and $same_team){ ?>
      					  <form style="margin-top:5px; height: 165px;" name="_form" action="<?php echo $_SERVER['php_self']?>" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');" enctype='multipart/form-data'>
                  	<table class="edit_table"> 
                  		<tr>
                  			<td>Name</td>
                  			<td><input style="width:200px;" id="name" name="name" size="15" maxlength="30" type="text" value="<?php echo $player->name;?>"/></td>
                  		  <td class="right_column"><span id="errorsDiv_name"></span></td>
                  		</tr>
                  		<tr>
                  			<td>Surname</td>
                  			<td><input style="width:200px;" id="surname" name="surname" size="15" maxlength="30" type="text" value="<?php echo $player->surname;?>"/></td>
                  		  <td class="right_column"><span id="errorsDiv_surname"></span></td>
                  		</tr>
                  		<tr>
                  			<td>Email</td>
                  			<td ><input style="width:200px;" id="email" name="email" size="15" maxlength="30" type="text" value="<?php echo $player->email;?>"/></td>
                  		  <td class="right_column"><span id="errorsDiv_email"></span></td>
                  		</tr>
                  		<tr><td colspan="3">&nbsp;</td></tr>
                  		<tr>
                  			<td>Photo</td>
                  			<td><input id="photo" style="width:200px;" type="file" size="20" name="userfile[]"></td>
                  			<td class="right_column"><span id="errorsDiv_photo"></span></td>
                  		</tr>
      					      <tr>
                  			<td>Busta</td>
                  			<td><input id="payslip" style="width:200px;" type="file" size="20" name="userfile[]"></td>
                  			<td class="right_column"><span id="errorsDiv_payslip"></span></td>
                  		</tr>
                  		<tr>
                  			<td style="text-align:left;"><a href="../teams/show.php?id=<?php echo $team->id?>"><img src="../../images/btn_back.gif" alt="indietro" /></a></td>
                  			<td><input id="commit" name="commit" class="send" type="submit" value="" /></td>
                  		</tr>
                  	</table>
                  </form>
                  <?php } ?>

                  <?php $index = 0 ?>
  					      <div style="height:260px;">
      					    <?php foreach ($team->players() as $player) {?>
      					      <?php $index += 1 ?>
                      <div class="player_widget" style="background-image: url('../../images/bg_players<?php echo ($index % 2) ? '1' : '2' ?>.gif');">
                        <span style="vertical-align:middle;">
                        <div style="padding:10px 5px 10px 10px;float:left;vertical-align:middle;display:inline;">
                          <img src="../../uploads/<?php echo $player->photo_url() ?>" width="30px" height="30px"/>
                        </div>
                        <div style="padding:10px 5px 10px 10px;float:left;display:inline;vertical-align:middle;">
                          <a style="text-decoration:none;color:#3f250e;" href="show.php?id=<?php echo $player->id ?>"><?php echo $player->full_name() ?> </a>
                          <?php if($same_team){ ?>
                          <br/>
                          <a href='delete.php?id=<?php echo $player->id ?>' onclick="return confirm('Are you sure you want to delete this player?')">delete</a>
                          <a href='edit.php?id=<?php echo $player->id ?>'>edit</a>
                          <?php } ?>
                        </div>
                        <div style="height:1px;clear:both;"></div>
                      </div>
      					    <?php }?>
    					    </div>
    					    
    					    <?php if(!$same_team){ ?>
    					    <div style="height:20px;clear:both;"></div>
                  <a style="float:right;" href="../teams/show.php?id=<?php echo $team->id?>"><img src="../../images/btn_back.gif" alt="indietro" /></a>          
                  <?php } ?>
    					    
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