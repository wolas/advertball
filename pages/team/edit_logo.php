<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php
	$team = Agency::find_by_id($session->agency_id)->team();
	
	if(isset($_POST['commit'])){
		/*
		 * @FileUploader - class to upload files 
		 */
		$max_file_size = 1048576;//max = 1mb
		$_file = new FileUploader();
		$_file->attach_file($_FILES['userfile']);
		//allow only jpeg/gif
		if($_file->type == "image/gif" || $_file->type == "image/jpeg"){
			unlink("../../uploads/" . $team->logo);
			$team->logo = $_file->filename;
			}else{	
			$message = "Only gif or jpeg images allowed";
		}
		//updates the DB 
		if($_file->save()) {
			// Success
    	redirect_to("show.php");
			} else {
			// Failure
     	$message = join("<br />", $_file->errors);
		}
		
		
		if(strlen($message) == 0){
		  if($team->update()){
  		  redirect_to("show.php");
  		  $session->save_team_id($team);
  		}else{
  		  $message = "Unable to insert data";	  
  		  redirect_to("form.php");
  		}
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
    					<li><a href="index.php" class="menu3on"><span>Squadre</span></a></li>
    					<li><a href="../programme.html" class="menu4"><span>Programma</span></a></li>
    					<li><a href="../sponsors.html" class="menu6"><span>Spondor</span></a></li>
    				</ul>
    			</div>
    			<div id="ctndx">
    			  <h2><img src="../../images/edit_logo.gif" /></h2>
    			  <div id="scroll-container">
    					<div id="content">
    					  <h2><?php echo $message ?></h2>
      					<form style="padding-left:90px; padding-top:100px;" name="_form" enctype="multipart/form-data" action="<?php echo $_SERVER['php_self']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
                	<table class="edit_table">
    					      <tr>
                			<td>Logo:</td>
                			<td>
                			  <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
    	    				      <input type="file" name="userfile" size="33" class="browse" />
    	    				    </td>
                		</tr>
                		<tr>
                			<td colspan="2">&nbsp;</td>
                		</tr>
                		<tr>
                			<td style="text-align:left;"><a href="show.php?id=<?php echo $team->id ?>"><img src="../../images/btn_back.gif" alt="Indietro"/></a></td>
                			<td style="text-align:right;"><input id="commit" name="commit" class="send" type="submit" value="" /></td>
                		</tr>
                	</table>
                </form>
    			    </div>
    			  </div>
    			  <div id="footer"><?php if($session->is_logged_in()){?><a href="logout.php">Logout</a> &bull; <?php }?><a href="../faq.html">Faq</a> &bull; <a href="../contact.html">Contatti</a></div>
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