<?php

	// Include the PHPMailer classes
	// If these are located somewhere else, simply change the path.
	require_once("phpMailer/class.phpmailer.php");
	require_once("phpMailer/class.smtp.php");
	require_once("phpMailer/language/phpmailer.lang-en.php");
	
	// mostly the same variables as before
	// ($to_name & $from_name are new, $headers was omitted) 
	$to_name = "Recipient Name";
	$to = "push@fastwebnet.it";
	$subject = "Mail Test at ".strftime("%T", time());
	$message = "This is a <b>test.</b>";
	$message  = "Hello Push, \n\n";
    $message .= "Your <b>personal</b> photograph <i>to this message</i>.\n\n";
    $message .= "Sincerely, \n";

	//$message = wordwrap($message,70);
	$from_name = "Sender Name";
	$from = "abc@abc.com";
	
	// PHPMailer's Object-oriented approach
	$mail = new PHPMailer();
	/*
	// Can use SMTP
	// comment out this section and it will use PHP mail() instead
	$mail->IsSMTP();
	$mail->Host     = "your.host.com";
	$mail->Port     = 25;
	$mail->SMTPAuth = false;
	$mail->Username = "your_username";
	$mail->Password = "your_password";
	*/
	// Could assign strings directly to these, I only used the 
	// former variables to illustrate how similar the two approaches are.
	$mail->FromName = $from_name;
	$mail->From     = $from;
	$mail->AddAddress($to, $to_name);
	$mail->Subject  = $subject;
	$mail->Body     = $message;
	//$mail->AddStringAttachment("abc", "../public/images/img2.jpg");
	$mail->AddAttachment("c:/temp/11-10-00.zip", "../public/images/test.zip");  // optional name
/*
if(!$mail->Send())
{
   echo "There was an error sending the message";
   exit;
}

echo "Message was sent successfully";
*/

	$result = $mail->Send();
	echo $result ? 'Sent' : 'Error';
  
?>