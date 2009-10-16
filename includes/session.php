<?php
	/*
	 * helps to work with sessions
	 * manages logging in & ot
	 */
   class Session{
   		private $logged_in;
   		private $admin;
		  public $message;
		  public $agency_id;
		  public $admin_id;
		  public $team_id;
		
   		function __construct(){
   			session_start();
			  $this->check_message();
  			$this->check_login();
  			$this->check_admin();
     	}
     	
     	public function save_team_id($team){
     	  if($team){$this->team_id = $_SESSION['team_id'] = $team->id;}
     	}
		
		  //return logged_in
  		public function is_logged_in(){
  			return $this->logged_in;
  		}
  		
  		//return logged_in
  		public function is_admin(){
  			return $this->admin == true;
  		}
		
  		//change login status
  		public function login($agency){
  			// check DB if inputted username/password
  			if($agency){
  				$this->agency_id = $_SESSION['agency_id'] = $agency->id;
  				$this->logged_in = true;
  			}
  		}
  		
  		//change login status for admins
  		public function admin_login($admin){
  		  if($admin){
  				$this->admin_id = $_SESSION['admin_id'] = $admin->id;
  				$this->admin = true;
  			}
  		}
		
  		//logout
  		public function logout(){
  			// check DB if inputted username/password
  			unset($_SESSION['agency_id']);
  			unset($_SESSION['team_id']);
  			unset($_SESSION['admin_id']);
  			$this->logged_in = false;
  			$this->admin = false;
  		}
		
		
  		//varify session status
  		private function check_login(){
  			if(isset($_SESSION['agency_id'])){
  				$this->agency_id = $_SESSION['agency_id'];
  				$this->logged_in = true;
  				}else{
  				unset($this->agency_id);
  				$this->logged_in = false;	
  			}
  		}
  		
  		//varify session status
  		private function check_admin(){
  			if(isset($_SESSION['admin_id'])){
  				$this->admin_id = $_SESSION['admin_id'];
  				$this->admin = true;
  				}else{
  				unset($this->admin_id);
  				$this->admin = false;	
  			}
  		}
		
  		//check message
  		private function check_message() {
  			// Is there a message stored in the session?
  			if(isset($_SESSION['message'])) {
  				// Add it as an attribute and erase the stored version
  	     		$this->message = $_SESSION['message'];
	      		unset($_SESSION['message']);
	    		} else {
	     		 $this->message = "";
	    	}
  		}
		
  		//dule funtion set/return message
  		public function message($msg="") {
  		  if(!empty($msg)) {
  		    // then this is "set message"
  		    // make sure you understand why $this->message=$msg wouldn't work
  		    $_SESSION['message'] = $msg;
  		 	 } else {
  		    // then this is "get message"
  				return $this->message;
  		  }
  		}

   }
   
   //instatiate
   $session = new Session();
   $message=$session->message();
   
?>
