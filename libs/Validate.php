<?php
class Validate{
	
	// Error array
	private $errors	= array();
	
	// Source array
	private $source	= array();
	
	// Rules array
	private $rules	= array();
	
	// Result array
	private $result	= array();
	
	// Contrucst
	public function __construct($source){
		$this->source = $source;
	}
	
	// Add rules
	public function addRules($rules){
		$this->rules = array_merge($rules, $this->rules );
	}
	
	// Get error
	public function getError(){
		return $this->errors;
	}
	
	// Set error
	public function setError($element, $message){
		$strElement = str_replace('_', ' ', $element);
		if(array_key_exists($element, $this->errors)){
			$this->errors[$element] .= ' - ' . $message;
		}else{
			$this->errors[$element] = '<b>' . ucwords($strElement) . ':</b> ' . $message;
		}
	}
	
	// Get result
	public function getResult(){
		return $this->result;
	}
	
	// Add rule
	public function addRule($element, $type, $options = null, $required = true){
		$this->rules[$element] = array('type' => $type, 'options' => $options, 'required' => $required);
		return $this;
	}
	
	// Run
	public function run(){
		foreach($this->rules as $element => $value){
			if($value['required'] == true && trim($this->source[$element])==null){
			//if($value['required'] == true){
				$this->setError($element, 'is not empty');
			}else{
				switch ($value['type']) {
					case 'int':
						$this->validateInt($element, $value['options']['min'], $value['options']['max']);
						break;
					case 'string':
						$this->validateString($element, $value['options']['min'], $value['options']['max']);
						break;
					case 'url':
						$this->validateUrl($element);
						break;
					case 'email':
						$this->validateEmail($element);
						break;
					case 'status':
					    $this->validateStatus($element, $value['options']);
						break;
					case 'group':
						$this->validateGroupID($element);
						break;
					case 'password':
						$this->validatePassword($element, $value['options']);
						break;
					case 'date':
						$this->validateDate($element, $value['options']['start'], $value['options']['end']);
						break;
					case 'existRecord':
						$this->validateExistRecord($element, $value['options']);
						break;
					case 'notExistRecord':
					    $this->validateNotExistRecord($element, $value['options']);
					    break;
					case 'string-notExistRecord':
						$this->validateString($element, $value['options']['min'], $value['options']['max']);
						$this->validateNotExistRecord($element, $value['options']);
						break;
					case 'email-notExistRecord':
						$this->validateEmail($element);
						$this->validateNotExistRecord($element, $value['options']);
						break;			
					case 'file':
						$this->validateFile($element, $value['options']);
						break;
					case 'size':
					    $this->validateSize($element, $value['options']);
					    break;
					case 'extension':
					    $this->validateExtension($element, $value['options']);
					    break;
					case 'ckeck-email':
					    $this->validateCheckEmailExists($element, $value['options']);
					    break;
				}
			}
			if(!array_key_exists($element, $this->errors)) {
				$this->result[$element] = $this->source[$element];
			}
		}
		$eleNotValidate = array_diff_key($this->source, $this->errors);
		$this->result	= array_merge($this->result, $eleNotValidate);
		
	}
	
	// Validate Integer
	private function validateInt($element, $min = 0, $max = 0){
	    if($this->source[$element]!= 0 && !filter_var($this->source[$element], FILTER_VALIDATE_FLOAT, array("options"=>array("min_range"=>$min,"max_range"=>$max)))){
	        $this->setError($element, 'is an invalid number');
	    }
	}
	
	// Validate String
	private function validateString($element, $min = 0, $max = 0){
		$length = strlen($this->source[$element]);
		if($length < $min) {
			$this->setError($element, 'is too short');
		}elseif($length > $max){
			$this->setError($element, 'is too long');
		}elseif(!is_string($this->source[$element])){
			$this->setError($element, 'is an invalid string');
		}
	}
	
	// Validate URL
	private function validateURL($element){
		if(!filter_var($this->source[$element], FILTER_VALIDATE_URL)){
			$this->setError($element, 'is an invalid url');
		}
	}
	
	// Validate Email
	private function validateEmail($element){
		if(!filter_var($this->source[$element], FILTER_VALIDATE_EMAIL)){
			$this->setError($element, 'is an invalid email');
		}
	}
	
	public function showErrors($textColor = null){
	    
		$xhtml = '';
		if(!empty($this->errors)){
			$xhtml .= '<ul class="list-unstyled mb-0 bg-danger">';
			foreach($this->errors as $key => $value){
				$xhtml .= '<li class="text-white" style="display: block;">'.$value.' </li>';
			}
			$xhtml .=  '</ul>';
		}

		
		return $xhtml;
	}
	
	public function showErrorsPublic($textColor = null){
	    
	    $xhtml = '';
	    if(!empty($this->errors)){
	        
	            $xhtml     .= '<div class="alert bg-danger alert-dismissible">';
	            $xhtml     .= '<ul>';
	            
	            foreach($this->errors as $key => $value){
	                $xhtml .= '<li class="text-white mt-3 mb-3" style="display: block;">'.$value.' </li>';
	            }
	            
	            $xhtml     .=  '</ul>';
	            $xhtml     .=  '</div>';
	    }
	    return $xhtml;
	}
	
	
	public function isValid(){
	 	if(count($this->errors)>0) return false;
	 	return true;	
	}
	
	// Validate Status
	private function validateStatus($element,$option){

		if(in_array($this->source[$element], $option['deny']) == true){
			$this->setError($element, 'Vui lòng chọn giá trị khác giá trị mặc định!');
		}
	}
	
	// Validate GroupID
	private function validateGroupID($element){
		if($this->source[$element] == 0){
			$this->setError($element, 'Select group');
		}
	}
	
	// Validate Password
	private function validatePassword($element, $options){		
		if($options['action'] == 'add' || ($options['action'] == 'edit' && $this->source[$element] )){
			$pattern = '#^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,8}$#';	// Php4567!
			if(!preg_match($pattern, $this->source[$element])){
				$this->setError($element, 'is an invalid password');
			};
		}
		
	}
	
	// Validate Date
	private function validateDate($element, $start, $end){		
		// Start
		$arrDateStart 	= date_parse_from_format('d/m/Y', $start) ;
		$tsStart		= mktime(0, 0, 0, $arrDateStart['month'], $arrDateStart['day'], $arrDateStart['year']);
			
		// End
		$arrDateEnd 	= date_parse_from_format('d/m/Y', $end) ;
		$tsEnd			= mktime(0, 0, 0, $arrDateEnd['month'], $arrDateEnd['day'], $arrDateEnd['year']);
		
		// Current
		$arrDateCurrent	= date_parse_from_format('d/m/Y', $this->source[$element]) ;
		$tsCurrent		= mktime(0, 0, 0, $arrDateCurrent['month'], $arrDateCurrent['day'], $arrDateCurrent['year']);
		
		if($tsCurrent < $tsStart || $tsCurrent > $tsEnd){
			$this->setError($element, 'is an invalid date');
		}
	}
	
	// Validate Exist record
	private function validateExistRecord($element, $options){
		$database = $options['database'];

		$query	  = $options['query'];
		if($database->isExist($query)==false){
			$this->setError($element, 'record is not exist');
		}
	}
    
	// Validate Not Exist record
	private function validateNotExistRecord($element, $options){
	    $database = $options['database'];
	    
	    $query	  = $options['query'];
	    if($database->isExist($query)==true){
	        $this->setError($element, 'giá trị này đã tồn tại.');
	    }
	}
	
	// Validate File
	//$this->validateFile($element, $value['options']);
	private function validateFile($element, $options){
	    if(isset($this->source[$element]['name'])){
    	    if($this->source[$element]['name'] != NULL){
        		if(!filter_var($this->source[$element]['size'], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>$options['min'],"max_range"=>$options['max'])))){
        			$this->setError($element, 'kích thước không phù hợp');
        		}
        		
        		$ext = pathinfo($this->source[$element]['name'], PATHINFO_EXTENSION);
        		if(in_array($ext, $options['extension']) == false){
        			$this->setError($element, 'phần mở rộng không phù hợp');
        		}
    	    } 
	    } else{
	        $this->setError($element, 'Hãy nhập một ảnh tại khung: choose file.');
	    }
	}
	
	private function validateSize($element, $options){
	    
	    if(!filter_var($this->source['imgSize'], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>$options['min'],"max_range"=>$options['max'])))){
	        $this->setError($element, 'Size does not fit');
	    }
	}
	
	private function validateExtension($element, $options){
	    
	    $ext = pathinfo($this->source['imgName'], PATHINFO_EXTENSION);
	    if(in_array($ext, $options) == false){
	        $this->setError($element, 'Extension does not fit');
	    }
	}
	
	private function validateCheckEmailExists($element, $options) {

	    // Kiểm tra xem email có hợp lệ hay không.
	    if (!filter_var($options['email'], FILTER_VALIDATE_EMAIL)) {
	        return false;
	    }
	    
	    // Tách miền khỏi email.
	    $domain = explode("@", $options['email'])[1];
	    
	    // Kiểm tra xem miền có tồn tại trên máy chủ DNS hay không.
	    $return = checkdnsrr($domain, "MX");
	    
	    if($return == false){
	        $this->setError($element, 'Extension does not fit');
	    }
	}
}










