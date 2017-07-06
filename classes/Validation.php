<?php

class Validation
{
	private $_passed = false;
	private $_errors = array();
	private $_db = null;
	
	
	public function __construct()
	{
		$this->_db = DB::getInstance();
	}
	
	public function check($fields = array())
	{
		foreach ($fields as $field => $rules) {
			foreach ($rules as $rule => $rule_value) {
				
				$value = escape(trim(Input::get($field)));
				$char_num = strlen($value);
				
				if(empty($value) && $rule === 'required') {
					$this->addError($field, "Field {$field} is required!");
				} else if(!empty($value)) {
					switch($rule) {
						case 'min':
							if($char_num < $rule_value) {
								$this->addError($field, "Field {$field} must have a minimum of {$rule_value} characters.");
							}
						break;
						case 'max':
							if($char_num > $rule_value) {
								$this->addError($field, "Field {$field} must have a maximum of {$rule_value} characters.");
							}
						break;
						case 'unique':
							$check = $this->_db->get($field, $rule_value,array($field, '=', $value));
							if($check->count()) {
								$this->addError($field, "{$field} already exists.");
							}
						break;
						case 'matches':
							if($value != Input::get($rule_value)) {
								$this->addError($field, "Field {$field} must match {$rule_value}.");
							}
						break;
					}
				}
				
			}
		}
		
		if(empty($this->_errors)) {
			$this->_passed = true;
		}
		
		return $this;
	}
	
	private function addError($field, $error)
	{
		$this->_errors[$field] = $error; 
	}
	
	public function hasError($field)
	{
		if(isset($this->_errors[$field])) {
			return $this->_errors[$field];
		}
		
		return false;
	}
	
	public function errors()
	{
		return $this->_errors;
	}
	
	public function passed()
	{
		return $this->_passed;
	}
}