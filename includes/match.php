<?php

class Match extends DatabaseObject{
	protected static $table_name='matches';
	protected static $db_fields=array('id','published', 'team1_id','team2_id','date','time','team1_goals','team2_goals','team1_reds','team2_reds','team1_yellows','team2_yellows');
	public $id;
	public $published;
	public $team1_id;
	public $team2_id;
	public $date;
	public $time;
	public $team1_goals;
	public $team2_goals;
	public $team1_reds;
	public $team2_reds;
	public $team1_yellows;
	public $team2_yellows;
	
	public function team1()
	{
    return Team::find_by_id($this->team1_id);
	}
	
	public function team2()
	{
    return Team::find_by_id($this->team2_id);
	}
	
	//common DB methods - can be placed inside DatabaseObject class in PHP 5.3
	//returns all records
	public static function find_all(){
		return self::find_by_sql("SELECT * FROM " . self::$table_name);
	}
	
	//returns record by id
	public static function find_by_id($id=0){
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM " . self::$table_name ." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	//returns record by sql
	public static function find_by_sql($sql=""){
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while($row=$database->fetch_array($result_set)){
			$object_array[] = self::instantiate($row);
		}
		return $object_array;
	}
	
	//return total records
	public static function count_all(){
		global $database;
		$sql = "SELECT COUNT(*) FROM " . self::$table_name;
		$result_set = $database->query($sql);
		$row = $database->fetch_array($result_set);
		return array_shift($row);//return just the first
	}
	
	//return all colunms
	private static function instantiate($record){
		$object  			= new self;
		//loop the colunms in table 
		foreach($record as $attribute => $value){
			if($object->has_attribute($attribute)){
				$object->$attribute  = $value;
			}
		}
		return $object;
	}
	
	//check if attribute exists 
	private function has_attribute($attribute){
		//get_object_vars return associative arrary with all attritbutes
		$object_vars = $this->attributes();
		return array_key_exists($attribute, $object_vars);
	}
	
	//abstract the DB table columbs
	protected function attributes(){
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(self::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;

		//return get_object_vars($this);
	}
	
	//escapes input value
	protected function sanitized_attributes(){
		global $database;
		$clean_attributes = array();
		// sanitize the values before submitting
		// Note: does not alter the actual value of each attribute
		foreach($this->attributes() as $key => $value){
			$clean_attributes[$key] = $database->escape_value($value);
		}
		return $clean_attributes;
	}
	
	//determins whether to execute update()/created() 
	public function save(){
		//new record won't have id
		return isset($this->id) ? $this->update() :  $this->create();
	}
	
	//insert into table
	public function create(){
		global $database;
		$attributes = $this->sanitized_attributes();
		
		$sql  = "INSERT INTO " . self::$table_name . " (";
		$sql .= join(", ",array_keys($attributes));
		$sql .= ") VALUES ('";
		$sql .= join("', '",array_values($attributes));
		$sql .= "')";
		
		//run sql
		if($database->query($sql)){
			$this->id=$database->insert_id($sql);
			//echo $database->insert_id($sql);
		//exit;
			return true;
			}else{
			return false;
		}
	}
	
	//update
	public function update(){
		global $database;
		
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		
		foreach($attributes as $key=> $value){
			$attribute_pairs[] = "{$key}='{$value}'";
		}
		
		$sql  = "UPDATE " . self::$table_name . " SET ";
		$sql .= join(",",$attribute_pairs);
		$sql .= " WHERE id=" .  $database->escape_value($this->id);
		
		$database->query($sql);
		return true;
	}
	
	//delete
	public function delete(){
		global $database;
		$sql   = "DELETE FROM " . self::$table_name . " ";
		$sql  .= "WHERE id=" . $database->escape_value($this->id);
		$sql  .= " LIMIT 1";
		$database->query($sql);
		return ($database->affected_rows()==1) ? true : false;
	}
	
}
?>