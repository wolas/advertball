<?php
	/*
	 * helps to work with sessions
	 * manages logging in & ot
	 */
   class Session{
   		private $logged_in;
		public $user_id;
		public $message;
		
   		function __construct(){
   			session_start();
			$this->check_message();
			$this->check_login();
			if($this->logged_in){
				}else{
			}
   		}
		
		//return logged_in
		public function is_logged_in(){
			return $this->logged_in;
		}
		
		//change login status
		public function login($user){
			// check DB if inputted username/password
			if($user){
				$this->user_id = $_SESSION['user_id'] = $user->id;
				$this->logged_in = true;
			}
		}
		
		//logout
		public function logout($user){
			// check DB if inputted username/password
			unset($_SESSION['user_id']);
			unset($this->user_id);
			$this->logged_in= false;
		}
		
		
		//varify session status
		private function check_login(){
			if(isset($_SESSION['user_id'])){
				$this->user_id = $_SESSION['user_id'];
				$this->logged_in = true;
				}else{
				unset($this->user_id);
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
