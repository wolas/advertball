<?php
	require_once(LIB_PATH.DS.'database.php');
    class FileUploader extends DatabaseObject{
    	protected static $table_name='photos';
		protected static $db_fields=array('id','filename','type','size','caption');
		public $id;
		public $filename;
		public $type;
		public $size;
		public $caption;
		public $maxFiles=3;
		private $temp_path;
		
		protected $upload_dir="uploads";
		
		private $files = array();
		
		//SITE_ROOT . DS . $this->upload_dir .DS. $this->filename
		public $errors=array();
		protected $upload_errors = array(
			// http://www.php.net/manual/en/features.file-upload.errors.php
			UPLOAD_ERR_OK 			 => "No errors.",
			UPLOAD_ERR_INI_SIZE  	 => "Larger than upload_max_filesize.",
		  	UPLOAD_ERR_FORM_SIZE 	 => "Larger than form MAX_FILE_SIZE.",
		  	UPLOAD_ERR_PARTIAL 		 => "Partial upload.",
		  	UPLOAD_ERR_NO_FILE 		 => "No file.",
		 	UPLOAD_ERR_NO_TMP_DIR    => "No temporary directory.",
		 	UPLOAD_ERR_CANT_WRITE    => "Can't write to disk.",
		 	UPLOAD_ERR_EXTENSION 	 => "File upload stopped by extension."
		);
		
		
		
		//Common DB methods - can be placed inside DatabaseObject class in PHP 5.3
	
		//Pass in $_FILE(['userfile']) as an argument
		public function attach_file($files) {
			//perform error checking on the form parameters
			if(!$files || empty($files) || !is_array($files)) {
				//error: nothing uploaded or wrong argument usage
				$this->errors[] = "No file was uploaded.";
				return false;
				}elseif($file['error'] != 0) {
					 // error: report what PHP says went wrong
				  	$this->errors[] = $this->upload_errors[$file['error']];
				  	return false;
				}else{
					
					while(list($key,$value) = each($_FILES['userfile']['name'])){
						if(!empty($value)){
							$filename = $value;
							$files[] = $filename; 
						
							$filename= SITE_ROOT . DS . $this->upload_dir . DS . str_replace(" ","_",$filename);// Add _ inplace of blank space in file name, you can remove this line
		 					
							//echo $filename."<br />";//$_FILES['userfile']['name'][$key];
					     	
							//echo $_FILES['userfile']['tmp_name'][$key];
							// echo "<br>";
							//copy($_FILES['userfile']['tmp_name'][$key], $upload_dir);
							//echo $_FILES['userfile']['tmp_name'][$key];
							move_uploaded_file($_FILES['userfile']['tmp_name'][$key],$filename);
							//unset($_FILES['userfile']['tmp_name'][$key]);
							//chmod("$filename",0777);
							//return true;
							}else{
							echo $_FILES['userfile'];
						}
					}
					
		
			
			/*
			// Perform error checking on the form parameters
			if(!$file || empty($file) || !is_array($file)) {
				 // error: nothing uploaded or wrong argument usage
				 $this->errors[] = "No file was uploaded.";
				 return false;
				} elseif($file['error'] != 0) {
					 // error: report what PHP says went wrong
				  	$this->errors[] = $this->upload_errors[$file['error']];
				  	return false;
				} else {
				// Set object attributes to the form parameters.
				  $this->temp_path  = $file['tmp_name'];
				  $this->filename   = basename($file['name']);
				  $this->type       = $file['type'];
				  $this->size       = $file['size'];
				return true;*/
			}
		}
		
		//upload files
		public function save() {
			// A new record won't have an id yet.
			if(isset($this->id)) {
				// Really just to update the caption
				//$this->update();
			} else {
				
				
				// Make sure there are no errors
				// Can't save if there are pre-existing errors
			  	if(!empty($this->errors)) { return false; }
			  
				// Make sure the caption is not too long for the DB
			  	if(strlen($this->caption) > 255) {
					$this->errors[] = "The caption can only be 255 characters long.";
					return false;
				}
			
			// move the file 
				echo $this->filename;
				exit();
				
			  	// Can't save without filename and temp location
			  	if(empty($this->filename) || empty($this->temp_path)) {
			    	$this->errors[] = "The file location was not available.";
			    	return false;
			 	 }
				
				// Determine the target_path
			 	 $target_path = SITE_ROOT . DS . $this->upload_dir .DS. $this->filename;
				 
			 	 // Make sure a file doesn't already exist in the target location
			  	if(file_exists($target_path)) {
			   		$this->errors[] = "The file name '{$this->filename}' already exists. Please change the file name and try again.";
			    	return false;
			  	}
			
				// move the file 
				//echo count($this->filename);
				exit();
				if(move_uploaded_file($this->temp_path, $target_path)) {
					//success
					//save details to the database
					/*
					if($this->create()) {
						// We are done with temp_path, the file isn't there anymore
						unset($this->temp_path);
						return true;
					}
					*/
					unset($this->temp_path);
					return true;
					} else {
					// File was not moved.
			   		$this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
			   	 return false;
				}
			}
		}
		
		//delete record & remove file
		public function destroy(){
			if($this->delete()){
				$temp_path=SITE_ROOT.DS.$this->image_path();
				return unlink($temp_path) ? true : false;
				}else{
				return false;
			}
		}
		
		//return image path
		public function image_path(){
			return $this->upload_dir.DS.$this->filename;
		}
		//return size of imgae
		public function size_as_text(){
			if($this->size < 1024) {
				return "{$this->size} bytes";
			} elseif($this->size < 1048576) {
				$size_kb = round($this->size/1024);
				return "{$size_kb} KB";
			} else {
				$size_mb = round($this->size/1048576, 1);
				return "{$size_mb} MB";
			}
		}
		
		//returns all records
		public static function find_all(){
			return self::find_by_sql("SELECT * FROM " . self::$table_name);
		}
		
		//returns record by id
		public static function find_by_id($id=0){
			global $database;
			$result_array = self::find_by_sql("SELECT * FROM " . self::$table_name ." WHERE id={$database->escape_value($id)} LIMIT 1");
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
			/*$object->id			= $record['id'];
			$object->username	= $record['username'];
			$object->password	= $record['password'];
			$object->first_name = $record['first_name'];
			$object->last_name	= $record['last_name'];
			return $object;*/
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
		
		//abstruct the DB table columbs
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
		
		/*
		 * REPLACED with above save
		//determins whether to execute update()/created() 
		public function save(){
			//new record won't have id
			return isset($this->id) ? $this->update() :  $this->create();
		}
		*/
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
				$this->id=$database->insert_id();
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
			return ($database->affected_rows()==1) ? true : false;
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
