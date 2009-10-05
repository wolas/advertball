<?php
	/*
	 * helps to work with sessions
	 * manages logging in & ot
	 */
   class Session{
   		private $logged_in;
		  public $message;
		  public $agency_id;
		  public $team_id;
		
   		function __construct(){
   			session_start();
			  $this->check_message();
  			$this->check_login();
  			if($this->logged_in){
  				}else{
  			}
     	}
     	
     	public function save_team_id($team){
     	  if($team){
  				$this->team_id = $_SESSION['team_id'] = $team->id;
  			}
     	}
		
		  //return logged_in
  		public function is_logged_in(){
  			return $this->logged_in;
  		}
		
  		//change login status
  		public function login($agency){
  			// check DB if inputted username/password
  			if($agency){
  				$this->agency_id = $_SESSION['agency_id'] = $agency->id;
  				$this->logged_in = true;
  			}
  		}
		
  		//logout
  		public function logout(){
  			// check DB if inputted username/password
  			unset($_SESSION['agency_id']);
  			unset($this->agency_id);
  			$this->logged_in= false;
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
