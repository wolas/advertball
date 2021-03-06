<?php

class Team extends DatabaseObject{
	protected static $table_name='teams';
	protected static $db_fields=array('id','agency_id','name','colour1','colour2','logo','coach_name','coach_telephone','coach_email','assistant_name','assistant_telephone','assistant_email');
	public $id;
	public $agency_id;
	public $name;
	public $colour1;
	public $colour2;
	public $logo;
	public $coach_name;
	public $coach_telephone;
	public $coach_email;
	public $assistant_name;
	public $assistant_telephone;
	public $assistant_email;	
	
	public function points()
	{
	  $points = 0;
	  foreach($this->matches_won() as $match){$points += 3;}
	  foreach($this->matches_draw() as $match){$points += 1;}
	  return $points;
	}
	
	public function yellows()
	{
	  $reds = 0;
    foreach($this->matches_as_1() as $match){$reds += $match->team1_yellows;}
    foreach($this->matches_as_2() as $match){$reds += $match->team2_yellows;}
    return $reds;
	}
	
	public function reds()
	{
	  $reds = 0;
    foreach($this->matches_as_1() as $match){$reds += $match->team1_reds;}
    foreach($this->matches_as_2() as $match){$reds += $match->team2_reds;}
    return $reds;
	}
	
	public function goals()
	{
    $goals = 0;
    foreach($this->matches_as_1() as $match){$goals += $match->team1_goals;}
    foreach($this->matches_as_2() as $match){$goals += $match->team2_goals;}
    return $goals;
	}
	
	public function goals_received()
	{
    $goals = 0;
    foreach($this->matches_as_1() as $match){$goals += $match->team2_goals;}
    foreach($this->matches_as_2() as $match){$goals += $match->team1_goals;}
    return $goals;
	}
	
	public function matches()
	{
	  $sql = "SELECT * FROM matches WHERE team1_id='$this->id' OR team2_id='$this->id'";
    return Match::find_by_sql($sql);
	}
	
	public function matches_won()
	{
	  $matches = array();
	  foreach($this->matches_as_1() as $match ){if($match->team1_goals > $match->team2_goals){$matches[] = $match;}}
	  foreach($this->matches_as_2() as $match ){if($match->team2_goals > $match->team1_goals){$matches[] = $match;}}
	  return $matches;
	}
	
	public function matches_draw()
	{
	  $matches = array();
	  foreach($this->matches_as_1() as $match ){if($match->team1_goals == $match->team2_goals){$matches[] = $match;}}
	  foreach($this->matches_as_2() as $match ){if($match->team2_goals == $match->team1_goals){$matches[] = $match;}}
	  return $matches;
	}
	
	public function matches_lost()
	{
	  $matches = array();
	  foreach($this->matches_as_1() as $match ){if($match->team1_goals < $match->team2_goals){$matches[] = $match;}}
	  foreach($this->matches_as_2() as $match ){if($match->team2_goals < $match->team1_goals){$matches[] = $match;}}
	  return $matches;
	}
	
	public function matches_as_1()
	{
	  $sql = "SELECT * FROM matches WHERE team1_id='$this->id'";
    return Match::find_by_sql($sql);
	}
	
	public function matches_as_2()
	{
	  $sql = "SELECT * FROM matches WHERE team2_id='$this->id'";
    return Match::find_by_sql($sql);
	}
	
	public function agency()
	{
	  return Agency::find_by_id($this->agency_id);
	}
	
	public function delete_logo()
	{
	  unlink(SITE_ROOT . DS . "uploads" . DS . $this->logo_url());
	}
	
	public function logo_url()
	{
	  return "team_" . $this->id . DS . $this->logo;
	}
	
	public function players()
	{
	  $sql = "SELECT * FROM players WHERE team_id = '" . $this->id . "'";
	  return Player::find_by_sql($sql);
	}
	
	//autheticates 
	public static function authenticate($username='',$password=''){
		global $database;
		$username=$database->escape_value($username);
		$password=$database->escape_value($password);
		//query
		$sql  = "SELECT * FROM users ";
		$sql .= "WHERE username = '{$username}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";
		
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
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