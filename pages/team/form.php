<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php
	
	
	if(isset($_POST['commit'])){
	  	$team = new Team();
		$attributes = array();
		$team->name = $_POST['name'];
		$team->colour1 = $_POST['colour1'];
		$team->colour2 = $_POST['colour2'];
		$team->coach_name = $_POST['coach_name'];
    	$team->coach_email = $_POST['coach_email'];
    	$team->coach_telephone = $_POST['coach_telephone'];
    	$team->assistant_name = $_POST['assistant_name'];
    	$team->assistant_email = $_POST['assistant_email'];
    	$team->assistant_telephone = $_POST['assistant_telephone'];
   	 	$team->agency_id = $session->user_id;

		/*
		 * @FileUploader - class to upload files 
		 */
		$max_file_size = 1048576;//max = 1mb
		$_file = new FileUploader();
		$_file->attach_file($_FILES['userfile']);
		//allow only jpeg/gif
		if($_file->type == "image/gif" || $_file->type == "image/jpeg"){
			$team->logo = $_file->filename;
			}else{	
			echo "Only gif or jpeg allowed";
			exit;
			
		}
		//updates the DB 
		if($_file->save()) {
			// Success
    		$session->message("Photograph uploaded successfully.");
			//redirect_to('list_photos.php');
			
			} else {
			// Failure
     		$message = join("<br />", $_file->errors);
		}
		
		
		
		if($team->create()){
		  redirect_to("show.php?id=".$team->id);
		}else{
		  $message = "Unable to insert data";	  
		  redirect_to("form.php");
		}
		
	}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Squadra <?php echo $team->name ?></title>
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
    				<h2>New team</h2>
  				
  					<form name="_form" enctype="multipart/form-data" action="<?php echo $_SERVER['php_self']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
            	<table>
            		<tr>
            			<td>Name:</td>
            			<td><input id="name" name="name" size="30" maxlength="30" type="text" value="<?php echo $team->name;?>"/></td>
            		  <td><span id="errorsDiv_name"></span></td>
            		</tr>
            		<tr>
            			<td>Colour 1:</td>
            			<td><input id="colour1" name="colour1" size="30" maxlength="30" type="text" value="<?php echo $team->colour1;?>"/></td>
            		  <td><span id="errorsDiv_colour1"></span></td>
            		</tr>
            		<tr>
            			<td>Colour 2:</td>
            			<td><input id="colour2" name="colour2" size="30" maxlength="30" type="text" value="<?php echo $team->colour2;?>"/></td>
            		  <td><span id="errorsDiv_colour2"></span></td>
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
            			<td>Assistant Coach Name:</td>
            			<td><input id="assistant_name" name="assistant_name" size="30" maxlength="30" type="text" value="<?php echo $team->assistant_name;?>"/></td>
            		  <td><span id="errorsDiv_assistant_name"></span></td>
            		</tr>	
            		<tr>
            			<td>Assistant Email:</td>
            			<td><input id="assistant_email" name="assistant_email" size="30" type="text" value="<?php echo $team->assistant_email;?>" /></td>
            		  <td><span id="errorsDiv_assistant_email"></span></td>
            		</tr>
            		<tr>
            			<td>Assistant Telephone:</td>
            			<td><input id="assistant_telephone" name="assistant_telephone" size="30" type="text"value="<?php echo $team->assistant_telephone;?>" /></td>
            		  <td><span id="errorsDiv_assistant_telephone"></span></td>
            		</tr>
					<tr>
            			<td>Logo :</td>
            			<td><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
	    				<span>Payslip: <input type="file" name="userfile" />
			</td>
            		  <td>&nbsp;</td>
            		</tr>
            		<tr>
            			<td>&nbsp;</td>
            			<td><input id="commit" name="commit" class="buttonstyle" type="submit" value="<?php echo $new_record ? 'save' : 'udpate'; ?>" /></td>
            		</tr>
            	</table>
            </form>
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