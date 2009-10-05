<?php 

	ob_start();
	require_once("../includes/initialize.php");
    include_once('../includes/phpMailer/class.phpmailer.php');

	if(isset($_POST['commit'])){
	//place address in single string
	$address;
	$address.=$_POST['street']."~";
	$address.=$_POST['city']."~";
	$address.=$_POST['state']."~";
	$address.=$_POST['postcode']."~";
	$address.=$_POST['area_code']."~";


	$agency = new Agency();
	$agency->company_name 		 = $_POST['company_name'];
	$agency->address 			= $address;
	$agency->contact_name 		= $_POST['contact_name'];
	$agency->contact_email   	= $_POST['contact_email'];
	$agency->contact_telephone  = $_POST['contact_telephone'];
	$agency->partita_iva        = $_POST['partita_iva'];
	$agency->legal_term         = $_POST['legal_term'];
	$agency->username           = $_POST['username'];
	$agency->password           = $_POST['password'];

	if(!$agency->create()){
		$session->message("Unable insert data...");
		}else{
		if($_POST['legal_term']==1){$agree="Si";}else{$agree="No";} 
		
		
		$body ='<html><head><title>Advertball</title></head><body>'; 
		$body .= "Pre-iscrizione effettuata con successo.<br/><br>" .
		    "<b>Benvenuto nel mondo Advertball!</b><br>\n" .
		    "A breve vi saranno comunicati via email i dettagli su come completare la registrazione.<br><br>" . 
		    "A-team<br>" . 
		    "Ecco i vostri dati:<br> <br> " .
				
				"<b>Azienda:</b> " . $_POST['company_name'] . "<br>" .
				"<b>Indirizzo:</b> " . $_POST['street'] . "<br>" .
				"<b>Citta:</b> " . $_POST['city'] . "<br>" .
				"<b>Regione:</b> " . $_POST['state'] . "<br>" .
				"<b>CAP:</b> " . $_POST['postcode'] . "<br>" .
				"<b>Nome:</b> " . $_POST['contact_name'] . "<br>" .
				"<b>Tel:</b> " .  $_POST['contact_telephone'] . "<br>" .
				"<b>Email:</b> " . $_POST['contact_email']  . "<br>" .
				"<b>Partiva IVA:</b> " . htmlspecialchars($_POST['partita_iva']) . "<br>" .
				 
				"<b>Username:</b>" . addslashes($_POST['username']) . "<br>" .
				"<b>Password:</b> " . $_POST['password'] . "<br><br>" .
				"<a href=\"http://www.advertball.it\">http://www.advertball.it</a>";
		  
    $to =$_POST['contact_email']; //array($_POST['contact_email'], "info@advertball.it");
    $subject = 'Advertball Confirmation';
   /*
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   //$headers .= 'From: advertball@advertball.it' . "\r\n" . 'Reply-To: info@advertball.it';
    $headers .= 'From: advertball@advertball.it' . "\r\n" . 'Reply-To: info@advertball.it';

   // $mail_sent = @mail( $to, $subject, $body, $headers );
    $mail_sent = @mail( $to, $subject, $body,$headers);
		//redirect_to("registration_complete.html");
		if($mail_sent){
			redirect_to("registration_complete.html");
		}*/
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->IsSendmail();

		$mail->SMTPAuth = true; 			// enable SMTP authentication
		$mail->SMTPSecure = "ssl"; 			// sets the prefix to the server
		/*
		$mail->Host = "smtp.gmail.com";    // sets GMAIL as the SMTP server
		$mail->Port = 465;                 // set the SMTP port
		$mail->Username = "pushpa.lama";   // GMAIL username
		$mail->Password = "00rg47bn44";    // GMAIL password
		$mail->From = "info.advertball.it";*/
		//$mailer->AddReplyTo('billing@yourdomain.com', 'Billing Department');
   		//look in config
		$mail->Host = SMTP_HOST;
		$mail->Port = SMTP_PORT; 
		$mail->Username = SMTP_USERNAME;  
		$mail->Password = SMTP_PASSWORD;
		
	
		$mail->FromName = "AdvertBall";
		$mailer->From = 'info@servizio.advertball.it';
		
		$mail->AddAddress($to);
		$mail->AddBCC("giuseppe.moltedo@teamalfa.it", "Recepient 1");
		$mail->Subject = "Advertball Confirmation";
		$mail->IsHTML(true);
		$mail->Body = $body;
		

		if(!$mail->Send()) {
			echo 'Message was not sent.';
			echo 'Mailer error: ' . $mail->ErrorInfo;
			} else {
			redirect_to("registration_complete.html");
		}


	}
  }  
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Advertball - Iscrizione</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta http-equiv="Content-Language" content="it"/>
  <meta name="script" http-equiv="Content-Script-Type" content="text/javascript"/>
  <meta name="script" http-equiv="Content-Style-Type" content="text/css"/>
  <meta name="description" content="Advertball - Il torneo di calcio a 7 dei profesionisti della comunicazione"/>
  <meta name="keywords" content="Y&R, Young&Rubicam Brands, VML, digital, Adidas, Birra Moretti, Fondazione Corti, ADC Group, Assocomunicazione, torneo a 7, torneo aziendale, CSI, Advertball, ball, comunicazione, calcio, agenzia di comunicazione, Actimel, Palmolive, Cisalfa Sport"/>
  <meta name="distribution" content="Global"/>
  <link rel="shortcut icon" href="images/icon.ico"> 
  <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen"/>
  <script type="text/javascript" src="../js/tab.js"></script>
  <script type="text/javascript" src="../js/scroll/prototype.js"></script>
	<script type="text/javascript" src="../js/scroll/slider.js"></script>
	<script type="text/javascript" src="../js/scroll/scroller.js"></script>
	<script type="text/javascript" src="../js/yav.js"></script>
	<script type="text/javascript" src="../js/yav-config.js"></script>
	<script>
      var rules=new Array();
      rules[0]="company_name:nome dell'agenzia|required";
      rules[1]='street:indirizzo|required';
      rules[2]='city:città|required';
      rules[3]='state:regione|required';
      rules[4]='postcode:CAP|required';
      rules[5]='contact_name:nome contatto|required';
      rules[6]='contact_email:email contatto|required';
      rules[7]='contact_email:contact email|email';
      rules[8]='contact_telephone:telefono|required';
      rules[9]='contact_telephone:telefono|numeric';
      rules[10]='partita_iva:partita IVA|required';
      rules[11]='username|required';
      rules[12]='password|required';
      rules[13]='legal_term|equal|1|Termini legali deve essere accettato';
      rules[14]='rules_term:Rules|equal|1|Regolamento deve essere accettato';
  </script>
	<script type="text/javascript" language="javascript">
	// <![CDATA[
	$(document).observe("dom:loaded", function() {
		new Control.Scroller( 'content', 'handle', 'track', {
			up: "button-up",
			down: "button-down"
		});
	});
	// ]]>
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
  					<li><a href="about.html" class="menu1"><span>Che cos'&egrave; Advertball</span></a></li>
  					<li><a href="rules.html" class="menu2"><span>Regolamento</span></a></li>
  					<li><a href="#1" class="menu3on"><span>Preiscrizione</span></a></li>
  					<li><a href="programme.html" class="menu4"><span>Programma</span></a></li>
  					<li><a href="sponsors.html" class="menu6"><span>Spondor</span></a></li>
  				</ul>
  			</div>
  			<div id="ctndx">
  				<h2><img src="../images/iscrizione.gif" alt="iscrizione" /></h2>
  				<div id="scroll-container">
  					<div id="track"><div id="handle"></div></div>
  					<div id="button-up"></div>
  					<div id="button-down"></div>
  					<div id="content">
				<h2>Istruzioni</h2>
                  
                  <p>Per partecipare ad Advertball 2009 – 2010, occorre:</p>                  
                  <br/>
                  <p>Compilare il modulo di pre-iscrizione ADVERTBALL 2009-2010 sul sito Internet entro il 2 Ottobre 2009.</p>
                  <br/>
                  <p>Effettuare il bonifico di anticipo pari a metà della quota di iscrizione, ovvero 780 € (totale iscrizione 1560 € a squadra) entro il 12 Ottobre.</p>
                  <br/>
                  <p>Effettuare il bonifico di saldo pari a 780 € (totale iscrizione 1560 € a squadra) entro il 19 Ottobre.</p>
                  <h4>DATI BONIFICO</h4>
                  
                  <p>Il versamento delle quote avviene tramite bonifico bancario intestato a: <b>Y&R Italia S.r.l</b>.</p>
                  <p>Coordinate: <b>IBAN IT80S0306909464018342530180</b></p>
                  <p>Causale 1° tranche di pagamento:</p>
                  <p><em>“Iscrizione Squadra <b>NOME - SOCIETA’</b>  Advertball 2009 - 2010 – ACCONTO”</em></p>
                  <p>Causale versamento saldo:</p>
                  <p><em>“Iscrizione Squadra <b>NOME - SOCIETA’</b> Advertball 2009 - 2010 – SALDO”</em><p>
                  <p>Alle società verranno inviate conferma d’avvenuta iscrizione e le ricevute di pagamento.</p>
                  

                  <h2>Modulo di Preiscrizione</h2>
                  <form name="_form" action="<?php echo $_SERVER['../public/pages/PHP_SELF']?>" id="_form" method="post" onSubmit="return yav.performCheck('_form', rules, 'inline');">
                    	<table width="600" height="435" border="0" cellspacing="0" cellpadding="0" class="sx">
                    		<tr>
                    			<td>Nome dell'agenzia:</td>
                    			<td><input id="company_name" name="company_name" type="text" /></td>
                    		  <td><span id="errorsDiv_company_name"></span></td>
                    		</tr>
                    		<tr>
                    			<td>Indirizzo:</td>
                    			<td><input id="street" name="street" type="text" /></td>
                    		  <td><span id="errorsDiv_street"></span></td>
                    		</tr>
                    		<tr>
                    			<td>Citt&agrave;:</td>
                    			<td><input id="city" name="city" type="text" /></td>
                    		  <td><span id="errorsDiv_city"></span></td>
                    		</tr>
                    		<tr>
                    			<td>Regione:</td>
                    			<td><input id="state" name="state" type="text" /></td>
                    		  <td><span id="errorsDiv_state"></span></td>
                    		</tr>
                    		<tr>
                    			<td>CAP:</td>
                    			<td><input id="postcode" name="postcode" type="text" /></td>
                    		  <td><span id="errorsDiv_postcode"></span></td>
                    		</tr>
                    		<tr>
                    			<td>Partita IVA:</td>
                    			<td><input id="partita_iva" name="partita_iva" type="text" /></td>
                    		  <td><span id="errorsDiv_partita_iva"></span></td>
                    		</tr>
                    		<tr>
                    			<td>Nome Contatto:</td>
                    			<td><input id="contact_name" name="contact_name" type="text" /></td>
                    		  <td><span id="errorsDiv_contact_name"></span></td>
                    		</tr>	
                    		<tr>
                    			<td>Email Contatto:</td>
                    			<td><input id="contact_email" name="contact_email" type="text" /></td>
                    		  <td><span id="errorsDiv_contact_email"></span></td>
                    		</tr>
                    		<tr>
                    			<td>Telefono:</td>
                    			<td><input id="contact_telephone" name="contact_telephone" type="text" /></td>
                    		  <td><span id="errorsDiv_contact_telephone"></span></td>
                    		</tr>
                  		  <tr>
                    			<td>Username:</td>
                    			<td><input id="username" name="username" type="text" />
                    		  <td><span id="errorsDiv_username"></span></td>
                    		</tr>
                    		<tr>
                    			<td>Password:</td>
                    			<td><input id="password" name="password" type="password" />
                    		  <td><span id="errorsDiv_password"></span></td>
                    		</tr>
                  		  <tr>
                    			<td valign="top" colspan="2" align="left"><input class="checkbox" type="checkbox" id="legal_term" name="legal_term" value="1" />&nbsp;&nbsp; <a href="#1" onclick="javascript:window.open('popup_privacy.html','','width=400,height=400,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,top=5,left=5');">Dichiaro di aver letto e accettato i termini legali</a></td>
                          <td><span id="errorsDiv_legal_term"></span></td>
                    		</tr>
                    		<tr>
                    			<td valign="top" colspan="2" align="left"><input class="checkbox" type="checkbox" id="rules_term" name="rules_term" value="1" />&nbsp;&nbsp; <a href="#1" onclick="javascript:window.open('rules_popup.html','','width=600,height=400,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,top=5,left=5');">Dichiaro di aver letto e accettato il regolamento</a></td>
                          <td><span id="errorsDiv_rules_term"></span></td>
                    		</tr>
                    		<tr>
                    		  <td colspan="3" align="right"><input id="commit" name="commit" class="invia" type="submit" value="" /></td>
                    		</tr>
                    	</table>
                    </form>
					<br /><br />
  					</div>
  				</div>
  				<div id="footer"><a href="faq.html">Faq</a> &bull; <a href="contact.html">Contatti</a></div>
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