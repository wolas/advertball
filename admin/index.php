<?php 
  require_once("../includes/initialize.php");
  if (!$session->is_logged_in()) { redirect_to("../login.php"); } 
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>:: Agencies ::</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="it"/>
    <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
    <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
    <meta name="distribution" content="Global"/>
    <link rel="shortcut icon" href="../images/icon.ico"> 
    <link rel="stylesheet" type="text/css" href="../css/admin.css" media="screen"/>
  </head>
  <body>

  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center" valign="middle">
  		<div id="page">
  			<div id="ctnsx">
  				<h1><a href="../index.html"><span>ADVERTBALL</span></a></h1>
  				<ul id="menu">
  					<li><a href="index.php" class="menu_blank">Admin Home</a></li>
  					<li><a href="agencies/index.php" class="menu_blank">Agencies</a></li>
  					<li><a href="teams/index.php" class="menu_blank">Teams</a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  				<h2>TITLE HERE</h2>
  				
  				
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