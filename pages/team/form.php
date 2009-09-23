<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_logged_in()){redirect_to("team_login.php");}
	
	$new_record = $_GET['id'] ? false : true;
	
	if($new_record){
	  //$team = Team::instantiate();
	}else{
	  $team = Team::find_by_id($_GET['id']);
	}
	
?>

<?php
	if(isset($_POST['commit'])){
		$attributes = array();
		$attributes['name'] 		 = $_POST['name'];
		$attributes['agency_id'] 		 = "1";
		$attributes['coach_name'] 		 = $_POST['coach_name'];
    $attributes['coach_email'] 		 = $_POST['coach_email'];
    $attributes['coach_telephone'] 		 = $_POST['coach_telephone'];
		
		$team = new Team($attributes);
		$team->save();
		redirect_to("index.php");
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>:: Team Registration ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="it"/>
    <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
    <meta name="distribution" content="Global"/>
    <link rel="shortcut icon" href="../../images/icon.ico"> 
    <link rel="stylesheet" type="text/css" href="../../css/admin.css" media="screen"/>
    <script src="../../js/yav.js"></script>
	    <script src="../../js/yav-config.js"></script>
		<link rel="stylesheet" href="../../css/admin.css" type="text/css" media="screen" title="no title" charset="utf-8">
	    <script>
	        var rules=new Array();
	        rules[0]='name|required';
	        rules[1]='agency_id|required';
	        rules[2]='coach_name:coach name|required';
	        rules[3]='coach_email:coach email|required';
	        rules[4]='coach_email:coach email|email';
	        rules[5]='coach_telephone:coach telephone|required';
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
  					<li><a href="../dashboard.php" class="menu_blank">Dashboard</a></li>
  					<li><a href="index.php" class="menu_blank">Agencies</a></li>
  					<li><a href="../teams/index.php" class="menu_blank">Teams</a></li>
  					<li><a href="../logout.php" class="menu_blank">Logout</a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  				<h2>Team</h2>
  				
  				<form name="_form" action="<?php echo $_SERVER['php_self']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
          	<table>
          		<tr>
          			<td>Name:</td>
          			<td><input id="name" name="name" size="30" maxlength="30" type="text" value="<?php echo $team->name;?>"/></td>
          		  <td><span id="errorsDiv_name"></span></td>
          		</tr>
          		<tr>
          			<td valign="top">Agency:</td>
          			<td><input id="agency_id" name="agency_id" size="30" type="text" value="<?php echo $team->agency_id;?>"/></td>
          		  <td><span id="errorsDiv_agency_id"></span></td>
          		</tr>
          		<tr>
          			<td>Coach Name:</td>
          			<td><input id="coach_name" name="coach_name" size="30" maxlength="30" type="text" value="<?php echo $team->coach_name;?>"/></td>
          		  <td><span id="errorsDiv_coach_name"></span></td>
          		</tr>	
          		<tr>
          			<td>Coach Email:</td>
          			<td><input id="coach_email" name="coach_email" size="30" type="text" value="<?php echo $team->coach_email;?>" /></td>
          		  <td><span id="errorsDiv_coach_email"></span></td>
          		</tr>
          		<tr>
          			<td>Contact Telephone:</td>
          			<td><input id="coach_telephone" name="coach_telephone" size="30" type="text"value="<?php echo $team->coach_telephone;?>" /></td>
          		  <td><span id="errorsDiv_coach_telephone"></span></td>
          		</tr>
          		<tr>
          			<td>&nbsp;</td>
          			<td><input id="commit" name="commit" class="buttonstyle" type="submit" value="<?php echo $new_record ? 'save' : 'udpate'; ?>" /></td>
          		</tr>
          	</table>
          	<br/>
          	<a href="index.php">Back</a>
          </form>
  			</div>
  		</div>
  	</td>
    </tr>
  </table>
  </body>
</html>
<?php ob_end_flush();?>