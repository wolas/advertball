<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_admin()){redirect_to("../session/login.php");}
	$agency = Agency::find_by_id($_GET['id']);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Crea partita</title>
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
      rules[0]='company_name:company name|required';
      rules[1]='street|required';
      rules[2]='city|required';
      rules[3]='state|required';
      rules[4]='postcode:post code|required';
      rules[5]='contact_name:contact name|required';
      rules[6]='contact_email:contact email|email';
      rules[7]='area_code:area code|required|Enter CAP';
      rules[8]='contact_telephone: contact telephone|required';
      rules[9]='contact_telephone:contact telephone|numeric';
      rules[10]='partita_iva: p. IVA|required';
      rules[11]='username|required';
      rules[12]='password|required';
      rules[7]='area_code|numeric';
      yav.addHelp('company_name', 'Enter your company name');
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
    			  <h2>Modifica Agenzia</h2>
    			  <div id="scroll-container">
    					<div id="content">
                <table class="edit_table">
              		<tr>
              			<td>Agency Name:</td>
              			<td class="right_column"><?php echo $agency->company_name;?></td>
              		</tr>
              		<tr>
              			<td valign="top">Street:</td>
              			<td class="right_column"><?php echo $street;?></td>
              		</tr>
              		<tr>
              			<td>City:</td>
              			<td class="right_column"><?php echo $city;?></td>
              		</tr>
              		<tr>
              			<td>State:</td>
              			<td class="right_column"><?php echo $state;?></td>
              		</tr>
              		<tr>
              			<td>CAP:</td>
              			<td class="right_column"><?php echo $cap;?></td>
              		</tr>
              		<tr>
              			<td>Contact Name:</td>
              			<td class="right_column"><?php echo $agency->contact_email;?></td>
              		</tr>	
              		<tr>
              			<td>Contact Email:</td>
              			<td class="right_column"><?php echo $agency->contact_email;?></td>
              		</tr>
              		<tr>
              			<td>Prefisso:</td>
              			<td class="right_column"><?php echo $prefix;?></td>
              		</tr>
              		<tr>
              			<td>Contact Telephone:</td>
              			<td class="right_column"><?php echo $number;?></td>
              		</tr>
              		<tr>
              			<td>Extension:</td>
              			<td class="right_column"><?php echo $extension;?></td>
              		</tr>
              		<tr>
              			<td>Partita IVA:</td>
              			<td class="right_column"><?php echo $agency->partita_iva;?></td>
              		</tr>
              		<tr>
          				  <td>Total Paid:</td>
          				  <td class="right_column"><?php echo $agency->amount_paid; ?></td>
          			  </tr>
          			  <tr><td colspan="2">&nbsp;</td></tr>
          			  <tr>
          				  <td>Team</td>
          				  <td class="right_column"><a href="../teams/show.php?id=<?php echo $agency->team()->id ?>" ><?php echo $agency->team()->name; ?></a></td>
          			  </tr>
          			  <tr><td colspan="2">&nbsp;</td></tr>
          			  <tr>
          				  <td><a href="index.php"><img src="../../images/btn_back.gif" alt="Back" /></a></td>
          				  <td><a href="edit.php?id=<?php echo $agency->id?>"><img src="../../images/btn_edit.gif" alt="Back" /></a></td>
          			  </tr>
              	</table>
              	<br/>
              	
    			    </div>
    			  </div>
    			  <div id="footer"><a href="../session/logout.php">Logout</a></div>
    			</div>
    		</div>
    	</td>
    </tr>
  </table>
</body>
</html>
<?php ob_end_flush();?>