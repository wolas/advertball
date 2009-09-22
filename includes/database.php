<?php
require_once(LIB_PATH.DS.'config.php');

class MySqlDatabase{
	private $connection;
	public $last_query;  
	private $magic_quotes_active;
	private $real_escape_string_exits;
	
	//constructor
	function __construct(){
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exits = function_exists("mysql_real_escape_string");//php 4.3 or higher
		
	}
   
	//connect to DB 
	public function open_connection(){
		$this->connection = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
		mysql_select_db(MYSQL_DB_NAME, $this->connection) or die(mysql_error());		
		if(!$this->connection){
			die("Database connection failed: " . mysql_error());
			}else{
			$db_select = mysql_select_db(MYSQL_DB_NAME,$this->connection);
			if(!$db_select){
		 		die("Database selection failed: " . mysql_error());
			}
		}	
   }
   
	//close connection
	public function close_connection(){
   		if(isset($this->connection)){
   			mysql_close($this->connection);
			unset($this->connection);
   		}
	}
   
	//query datatbase
	public function query($sql){
		$this->last_query = $sql;
		$result = mysql_query($sql,$this->connection);
		$this->confirm_query($result);
		return $result;
 	}
   
	//db-neutral method
	public function fetch_array($result_set){
		return mysql_fetch_array($result_set);
	}
   
   //db-neutral method
	public function num_rows($result_set){
		return mysql_num_rows($result_set);
	}
	
	//db-neutral method
	public function insert_id($result_set){
		return mysql_insert_id($this->connection);
	}
	
	//db-neutral method
	public function affected_rows($result_set){
		return mysql_affected_rows($this->connection);
		
	}
	
	//cleans variables for making it ready sql i.e escapes etc
	public function escape_value($value){
		if($this->real_escape_string_exits){//if for php 4.3 or higher
			//undo any magic quotes so mysql_real_escape_string can do  the work
				if($this->magic_quotes_active){$value = stripcslashes($value);}
				$value = mysql_real_escape_string($value);
			}else{//php 4.3 or less
				//if magic quotes not active then add slashes
				if(!$this->magic_quotes_active){$value = addslashes($value);}
			}
		return $value;
	}
	
	//confirm query
	private function confirm_query($result){
		if(!$result){
			$output  = "Database query failed: " . mysql_error() . "<br /><br />";
			//$output .= "Last query: " . $this->last_query;
			die($output);	
		}
	}
   
}


$database = new MySqlDatabase();
//$db =& $database;	
//$database->open_connection();
//$database->close_connection();
?>
