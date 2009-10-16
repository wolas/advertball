<?php 
	ob_start();
	require_once("../../includes/initialize.php");
	if(!$session->is_logged_in()){redirect_to("../session/login.php");}
	$agency = Agency::find_by_id($_GET['id']);
?>

<?php
	if(isset($_POST['commit'])){
		$address;
		$address.=$_POST['street']."~";
		$address.=$_POST['city']."~";
		$address.=$_POST['state']."~";
		$address.=$_POST['postcode']."~";
		$address.=$_POST['area_code']."~";
		//plcae telephone in string
		$telephone =$_POST['area_code']."~";
		$telephone.=$_POST['contact_telephone']."~";
		$telephone.=$_POST['extension'];
	
		$agency->company_name 		 = $_POST['company_name'];
		$agency->address 			= $address;
		$agency->contact_name 		= $_POST['contact_name'];
		$agency->contact_email   	= $_POST['contact_email'];
		$agency->contact_telephone  = $telephone;
		$agency->partita_iva        = $_POST['partita_iva'];
		$agency->amount_paid        = $_POST['amount_paid'];;
		$agency->legal_term         = $_POST['legal_term'];
		$agency->username           = $_POST['username'];
		$agency->password = $_POST['password'];
		$agency->save();
		redirect_to("index.php");
		}else{
		
		list($street, $city, $state, $cap) = explode("~", $agency->address);
		list($prefix, $number, $extension) = explode("~", $agency->contact_telephone);	
	}
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
    			  <h2><img src="../../images/edit_team.gif" alt="Modifica Squadra" /></h2>
    			  <div id="scroll-container">
    					<div id="content">
			          <h2>TITLE</h2>
			
        				<form name="_form" action="<?php echo $_SERVER['php_self']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
                	<table>
                		<tr>
                			<td>Agency Name:</td>
                			<td><input id="company_name" name="company_name" size="30" maxlength="30" type="text" value="<?php echo $agency->company_name;?>"/></td>
                		  <td><span id="errorsDiv_company_name"></span></td>
                		</tr>
                		<tr>
                			<td valign="top">Street:</td>
                			<td><textarea id="street" name="street" rows="4" cols="26"><?php echo $street;?></textarea></td>
                		  <td><span id="errorsDiv_street"></span></td>
                		</tr>
                		<tr>
                			<td>City:</td>
                			<td><input id="city" name="city" size="30" maxlength="30" type="text" value="<?php echo $city;?>"/></td>
                		  <td><span id="errorsDiv_city"></span></td>
                		</tr>
                		<tr>
                			<td>State:</td>
                			<td><input id="state" name="state" size="30" maxlength="30" type="text" value="<?php echo $state;?>" /></td>
                		  <td><span id="errorsDiv_state"></span></td>
                		</tr>
                		<tr>
                			<td>CAP:</td>
                			<td><input id="postcode" name="postcode" size="30" maxlength="12" type="text" value="<?php echo $cap;?>" /></td>
                		  <td><span id="errorsDiv_postcode"></span></td>
                		</tr>
                		<tr>
                			<td>Contact Name:</td>
                			<td><input id="contact_name" name="contact_name" size="30" type="text" value="<?php echo $agency->contact_email;?>" /></td>
                		  <td><span id="errorsDiv_contact_name"></span></td>
                		</tr>	
                		<tr>
                			<td>Contact Email:</td>
                			<td><input id="contact_email" name="contact_email" size="30" type="text" value="<?php echo $agency->contact_email;?>" /></td>
                		  <td><span id="errorsDiv_contact_email"></span></td>
                		</tr>
                		<tr>
                			<td>Prefisso:</td>
                			<td><input id="area_code" name="area_code" size="5" maxlength="4" type="text" value="<?php echo $prefix;?>" /></td>
                		  <td><span id="errorsDiv_area_code"></span></td>
                		</tr>
                		<tr>
                			<td>Contact Telephone:</td>
                			<td><input id="contact_telephone" name="contact_telephone" size="30" type="text"value="<?php echo $number;?>" /></td>
                		  <td><span id="errorsDiv_contact_telephone"></span></td>
                		</tr>
                		<tr>
                			<td>Extension:</td>
                			<td><input id="extension" name="extension" size="5" maxlength="6" type="text" value="<?php echo $extension;?>" /></td>
                		</tr>
                		<tr>
                			<td>Partita IVA:</td>
                			<td><input id="partita_iva" name="partita_iva" size="30" maxlength="250" type="text" value="<?php echo $agency->partita_iva;?>" /></td>
                		  <td><span id="errorsDiv_partita_iva"></span></td>
                		</tr>

                		<tr>
            				<td>Total Paid:</td>
            				<td><input id="amount_paid" name="amount_paid" size="30" maxlength="9" type="text" value="<?php echo $agency->amount_paid; ?>" /></td>
            			</tr>
            			<tr>
                			<td valign="top">I agree to legal terms</td>
                			<td><input type="checkbox" id="legal_term" name="legal_term" value="1" checked /></td>
                		</tr>
                		<tr>
                			<td>Username:</td>
                			<td><input id="username" name="username" size="30" maxlength="12" type="text" value="<?php echo $agency->username;?>" />
                		  <td><span id="errorsDiv_username"></span></td>
                		</tr>
                		<tr>
                			<td>Password:</td>
                			<td><input id="password" name="password" size="30" maxlength="12" type="password" value="<?php echo $agency->password;?>" />
                		  <td><span id="errorsDiv_password"></span></td>
                		</tr>
                		<tr>
                			<td>&nbsp;</td>
                			<td><input id="commit" name="commit" class="buttonstyle" type="submit" value="update" /></td>
                		</tr>
                	</table>
                	<br/>
                	<a href="index.php">Back</a>
                </form>
    			    </div>
    			  </div>
    			  <div id="footer"><a href="logout.php">Logout</a> &bull; <a href="../../pages/matches/index.php">Public Site</a></div>
    			</div>
    		</div>
    	</td>
    </tr>
  </table>
</body>
</html>
<?php ob_end_flush();?>