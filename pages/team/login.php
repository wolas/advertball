<?php
	require_once("../../includes/initialize.php");
	
	//forward if already logged in
	if($session->is_logged_in()){
		redirect_to("form.php");
	}
	
	//if form submitted
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
	
		//check DB if submitted username /password exists
		$agency=Agency::authenticate($username,$password);
		
		if($agency){
			$session->login($agency);
			$agency->team() ? redirect_to("show.php") : redirect_to("form.php");
		}else{
			//username/password not found
			$message = "Username or Password incorrect!";
		}
	}else{//form has't been submitted  
		$username = '';
		$password = '';
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
    		      <?php echo output_message($message); ?>

    		      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          		  <table>
          		    <tr>
          		      <td>Username:</td>
          		      <td>
          		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
          		      </td>
          		    </tr>
          		    <tr>
          		      <td>Password:</td>
          		      <td>
          		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
          		      </td>
          		    </tr>
          		    <tr>
          		      <td colspan="2">
          		        <input type="submit" name="submit" value="Login" />
          		      </td>
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
<?php if(isset($database)) { $database->close_connection(); } ?>