<?php
	require_once("../includes/initialize.php");
	if(!$session->is_logged_in()){redirect_to("login.php");}
?>
<?php
	$max_file_size = 1048576;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB
	$_file = new FileUploader();
	$max_img  = $_file->maxFiles;
	//$message = "";
	if(isset($_POST['submit'])) {
		
		//instatiate
		//$_file = new FileUploader();
		//$file->caption = $_POST['caption'];
		$_file->attach_file($_FILES['userfile']);
		//$_file->attach_file($_FILES);
		
		if($_file->save()) {
			// Success
    		$session->message("Photograph uploaded successfully.");
			//redirect_to('list_photos.php');
			} else {
			// Failure
			//echo $message;
     		$message = join("<br />", $_file->errors);
		}
		/*
		$upload_dir= SITE_ROOT . DS . "uploads" .DS;
		
		while(list($key,$value) = each($_FILES['userfile']['name'])){
			
			if(!empty($value)){
				$filename = $value;
				
					$filename= $upload_dir . str_replace(" ","_",$filename);// Add _ inplace of blank space in file name, you can remove this line
 					
					//echo $_FILES['userfile']['type'][$key];
			     	// echo "<br>";
					//copy($_FILES['userfile']['tmp_name'][$key], $upload_dir);
					//echo $_FILES['userfile']['tmp_name'][$key];
					move_uploaded_file($_FILES['userfile']['tmp_name'][$key],$filename);
					//chmod("$filename",0777);
			

			}
		}
		*/
		
	}
?>

<?php //include_layout_template('admin_header.php'); ?>
<html>
	<head>
		<title>Uploads</title>
	</head>
	<body>
		<h2>Photo Upload</h2>
	
		<?php echo output_message($message); ?>
		<?php
			$max_no_img=3;
			echo "<form  action=\"". $_SERVER['PHP_SELF'] ."\"". " method=\"POST\" enctype='multipart/form-data'>\n";
			echo "<table border='0' width='400' cellspacing='0' cellpadding='0' align=center>\n";
			
			$ftype=array('logo','payslip','player');
			
			for($i=1; $i<=$max_img; $i++){
				echo "<tr>\n
						<td>" . ucfirst($ftype[$i-1]) . "</td>\n
						<td><input type=file name='userfile[]' class='bginput'></td>\n
					  </tr>\n";
			}
			
			echo "<tr>\n
				  	<td colspan=2 align=center><input type=\"submit\" name =\"submit\" value='upload'></td>\n
				  </tr>\n";
			echo "</form> </table>";
		?>
		<br />
		<br />
		<br />
		<br />
		<form name="form1" id="form1" action="<?php $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" method="POST">
	    	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
	    	<span>Payslip: <input type="file" name="userfile[]" /> <input type="submit" name="submit" value="Upload" /></span><br />
			
	    	<p>Caption: <input type="text" name="caption" value="" /></p>
	    	
		</form>
  
	</body>
<?php //include_layout_template('admin_footer.php'); ?>
</html>	
