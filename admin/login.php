<?php
	require_once("../includes/initialize.php");
	
	//forward if already logged in
	if($session->is_logged_in()){
		redirect_to("dashboard.php");
	}
	
	//if form submitted
	if(isset($_POST['submit'])){
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
	//$administrator=new Administrator();
	
		//check DB if submitted username /password exists
		$administrator=Administrator::authenticate($username,$password);
		
		if($administrator){
			$session->login($administrator);
			redirect_to("dashboard.php");
			}else{
			//username/password not found
			$message = "Username/Password incorrect!";
		}
	}else{//form has't been submitted  
		$username = '';
		$password = '';
	}
?>


<html>
  <head>
    <title>:: Advertball: CMS ::</title>
    <link href="../css/main.css" media="all" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="header">
      <h2>Login: Advertball</h2>
    </div>
    <div id="main">
		<?php echo output_message($message); ?>

		<form action="login.php" method="post">
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
    </div>
    <div id="footer">Copyright <?php echo date("Y", time()); ?>, Advertball </div>
  </body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>
