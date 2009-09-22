<?php
    //+redirects browser
	function redirect_to($location=NULL){
		
    	if($location != NULL){
    		header("Location: {$location}");
			exit;
    	}
    }
	
	//+message output
	function output_message($message="") {
	  if (!empty($message)) { 
	    return "<p class=\"message\">{$message}</p>";
	  	} else {
	    return "";
	  }
	}
	
	//hander when relevant class not found
	function __autoload($class_name){
		$class_name = strtolower($class_name);
		$path = LIB_PATH.DS."{$class_name}.php";
		if(file_exists($path)){
			require_once($path);
			}else{
			die("The file {$class_name}.php could not be found!");
		}
	}

	//include paths
	function include_layout_template($template=""){
		include(SITE_ROOT.DS.$template);
	}
?>
