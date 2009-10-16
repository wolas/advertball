<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_admin()){redirect_to("../session/login.php");}

  $team = Team::find_by_id($_GET['id']);
  
  if(isset($_POST['commit'])){
	  $player = new Player();
	  $player->name = $_POST['name'];
	  $player->number = $_POST['number'];
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

		redirect_to("manage.php?id=" . $team->id);
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
    <link rel="stylesheet" type="text/css" href="../../css/admin.css" media="screen"/>
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
      rules[7]='number|required';
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
      					<li><a href="../agencies/index.php" class="menu_blank">Agencies</a></li>
      					<li><a href="../teams/index.php" class="menu_blank">Teams</a></li>
      					<li><a href="../matches/index.php" class="menu_blank">Matches</a></li>
      				</ul>
      			</div>
      			<div id="ctndx">
      			  <h2><img src="../../images/players.gif" alt="Modifica Squadra" /></h2>
      			  <div id="scroll-container">
      					<div id="content">
      				    <?php if(count($team->players()) != 15){ ?>
                  <div style="border:1px solid #cccccc; padding:5px;width: 500px;">
        					  <form style="height: 190px;" name="_form" action="<?php echo $_SERVER['php_self']?>" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');" enctype='multipart/form-data'>
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
                    			<td>Number</td>
                    			<td><input style="width:200px;" id="number" name="number" size="15" maxlength="30" type="text" value="<?php echo $player->number;?>"/></td>
                    		  <td class="right_column"><span id="errorsDiv_number"></span></td>
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
                  </div>
                  <?php } ?>
                  
                  <?php $index = 0 ?>
  					      <div style="height:240px;">
      					    <?php foreach ($team->players() as $player) {?>
      					      <?php $index += 1 ?>
                      <a href="show.php?id=<?php echo $player->id ?>">
                        <div class="player_widget" style="background-image: url('../../images/bg_players<?php echo ($index % 2) ? '1' : '2' ?>.gif');">
                          <span style="vertical-align:middle;">
                          <div style="padding:10px 5px 10px 10px;float:left;vertical-align:middle;display:inline;">
                            <img src="../../uploads/<?php echo $player->photo_url() ?>" width="30px" height="30px"/>
                          </div>
                          <div style="padding:10px 5px 10px 10px;float:left;display:inline;vertical-align:middle;">
                            <?php echo $player->name . " " . $player->surname ?> 
                            <br/>
                            <? echo $player->email ?>
                          </div>
                          <div style="height:1px;clear:both;"></div>
                        </div>
                      </a>
      					    <?php }?>
    					    </div>
      			    </div>
      			  </div>
      			  <div id="footer"><a href="../session/logout.php">Logout</a> &bull; <a href="../../pages/players/manage.php?id=<?php echo $team->id ?>">Public Site</a></div>
      			</div>
      		</div>
    	  </td>
      </tr>
    </table>
  </body>
</html>
<?php ob_end_flush();?>