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
				
				if(empty($value) && $rule === 'required') {
					
				} else if(!empty($value)) {
					
				}
				
			}
		}
		die();
		return $this;
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