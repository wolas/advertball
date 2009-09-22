<?php require_once("../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("../login.php"); } ?>

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
      				<h1><a href="index.html"><span>ADVERTBALL</span></a></h1>
      				<ul id="menu">
      				  <li><a href="dashboard.php" class="menu_blank">Dashboard</a></li>
      					<li><a href="agencies/index.php" class="menu_blank">Agencies</a></li>
      					<li><a href="teams/index.php" class="menu_blank">Teams</a></li>
      					<li><a href="logout.php" class="menu_blank">Logout</a></li>
      				</ul>
      			</div>
      			<div id="ctndx">
      				<h2>TITLE</h2>
  				
  				
      			</div>
    		  </div>
    	  </td>
      </tr>
    </table>
  </body>
</html>
