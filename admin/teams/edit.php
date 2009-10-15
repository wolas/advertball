<?php 
	ob_start();
	require_once("../../includes/initialize.php");
?>

<?php
  $team = Team::find_by_id($_GET['id']);

	if($team == null){redirect_to("index.php");}
	
	if(isset($_POST['commit'])){
		$team->name = $_POST['name'];
		$team->colour1 = $_POST['colour1'];
		$team->colour2 = $_POST['colour2'];
		$team->coach_name = $_POST['coach_name'];
  	$team->coach_email = $_POST['coach_email'];
  	$team->coach_telephone = $_POST['coach_telephone'];
  	$team->assistant_name = $_POST['assistant_name'];
  	$team->assistant_email = $_POST['assistant_email'];
  	$team->assistant_telephone = $_POST['assistant_telephone'];
		
		if($_FILES['logo']['name']){
		  $upload_dir= SITE_ROOT . DS . "uploads" . DS . "team_" . $team->id . DS;
		  $value = $_FILES['logo']['name'];
		  $extension = substr($value, strrpos($value, '.'));
		  $name = "logo" . $extension;
			$filename = $upload_dir . $name;
			$team->logo = $name;
		}
		
		if($team->save()){
  		if(isset($filename)){move_uploaded_file($_FILES['logo']['tmp_name'], $filename);}
		  redirect_to("show.php?id=" . $team->id);
		}else{
		  $message = "Unable to insert data";	  
		}
		
	}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Modifica Squadra <?php echo $team->name ?></title>
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
        var rules=new Array();
        rules[0]='name|required';
        rules[1]='agency_id|required';
        rules[2]='coach_name:coach name|required';
        rules[3]='coach_email:coach email|required';
        rules[4]='coach_email:coach email|email';
        rules[5]='coach_telephone:coach telephone|required';
        rules[6]='assistant_email:assistant email|email';
        rules[7]='colour1|required';
        rules[8]='colour2|required';
        
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
    			  <h2><img src="../../images/edit_team.gif" alt="Modifica Squadra" /></h2>
    			  <div id="scroll-container">
    					<div id="content">
    					  <h3><?php echo $message ?></h3>
  				  	  <form class="center_table" name="_form" enctype="multipart/form-data" action="<?php echo $_SERVER['php_self']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
                	<table class="edit_table center_table" style="font-weight: bold;">
                		<tr>
                			<td>Nome</td>
                			<td><input id="name" name="name" size="30" maxlength="30" type="text" value="<?php echo $team->name;?>"/></td>
                		  <td><span id="errorsDiv_name"></span></td>
                		</tr>
                		<tr>
                			<td>Colore 1</td>
                			<td><input id="colour1" name="colour1" size="30" maxlength="30" type="text" value="<?php echo $team->colour1;?>"/></td>
                		  <td><span id="errorsDiv_colour1"></span></td>
                		</tr>
                		<tr>
                			<td>Colore 2</td>
                			<td><input id="colour2" name="colour2" size="30" maxlength="30" type="text" value="<?php echo $team->colour2;?>"/></td>
                		  <td><span id="errorsDiv_colour2"></span></td>
                		</tr>
                		<tr><td colspan="3" class="table_separator">&nbsp;</td></tr>
                		<tr>
                			<td>Coach Name</td>
                			<td><input id="coach_name" name="coach_name" size="30" maxlength="30" type="text" value="<?php echo $team->coach_name;?>"/></td>
                		  <td><span id="errorsDiv_coach_name"></span></td>
                		</tr>	
                		<tr>
                			<td>Coach Email</td>
                			<td><input id="coach_email" name="coach_email" size="30" type="text" value="<?php echo $team->coach_email;?>" /></td>
                		  <td><span id="errorsDiv_coach_email"></span></td>
                		</tr>
                		<tr>
                			<td>Contact Telephone</td>
                			<td><input id="coach_telephone" name="coach_telephone" size="30" type="text" value="<?php echo $team->coach_telephone;?>" /></td>
                		  <td><span id="errorsDiv_coach_telephone"></span></td>
                		</tr>
                		<tr><td colspan="3" class="table_separator">&nbsp;</td></tr>
                		<tr>
                			<td>Assistant Coach Name</td>
                			<td><input id="assistant_name" name="assistant_name" size="30" maxlength="30" type="text" value="<?php echo $team->assistant_name;?>"/></td>
                		  <td><span id="errorsDiv_assistant_name"></span></td>
                		</tr>	
                		<tr>
                			<td>Assistant Email</td>
                			<td><input id="assistant_email" name="assistant_email" size="30" type="text" value="<?php echo $team->assistant_email;?>" /></td>
                		  <td><span id="errorsDiv_assistant_email"></span></td>
                		</tr>
                		<tr>
                			<td>Assistant Telephone</td>
                			<td><input id="assistant_telephone" name="assistant_telephone" size="30" type="text" value="<?php echo $team->assistant_telephone;?>" /></td>
                		  <td><span id="errorsDiv_assistant_telephone"></span></td>
                		</tr>
                		<tr><td colspan="3" class="table_separator">&nbsp;</td></tr>
                		<tr>
                			<td>Logo</td>
                			<td><input type="file" name="logo" size="33" class="browse" /></td>
                		</tr>
                		<tr><td colspan="3" class="table_separator">&nbsp;</td></tr>
                		<tr>
                			<td colspan="3">
                			  <input id="commit" name="commit" class="save" type="submit" value="" style="float:right"/>
                		    <a href="show.php?id=<?php echo $team->id ?>"><img src="../../images/btn_back.gif" style="float:left"/></a>
                		  </td>
                		</tr>
                	</table>
                </form>
    			    </div>
    			  </div>
    			  <div id="footer"><a href="logout.php">Logout</a></div>
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