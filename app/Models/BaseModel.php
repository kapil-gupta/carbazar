<?php
/**
 * Description of BaseModel
 *
 * @author KapilG
 */
namespace SmartCarBazar\Models;
class BaseModel extends \Eloquent {
	/*	variables	*/
	protected $errors;
	protected $validations;
	

	/*
	 * Constructor method
	 */	
	public function __construct($attributes = array(), $exists = false) {
        parent::__construct($attributes, $exists); // Eloquent)
		
		$this->errors = new \Illuminate\Support\MessageBag();
		$this->validations = new \Illuminate\Support\MessageBag();
	}
	
	/*
	 * 
	 */
	public static function boot() {
		parent::boot();
		
		static::creating(function($model) {
			if (Schema::hasColumn($model->getTable(), 'created_at'))
				$model->created_at = date('Y-m-d H:i:s');
			
			if(Schema::hasColumn($model->getTable(), 'created_by') && !$model->created_by) {
				$model->created_by = (Auth::check()) ? Auth::user()->id : 0;
			}
		});
		
		static::saving(function($model) {
			if(Schema::hasColumn($model->getTable(), 'updated_by') && !$model->updated_by) {
				$model->updated_by = (Auth::check()) ? Auth::user()->id : 0;
			}
		});
            
	}	// END: public static function boot() {
	
	/*
	 * 
	 */
	public function hasErrors() {
		return ($this->errors->count()) ? true : false;
	}	// END: public function hasErrors() {
	
	/*
	 * 
	 */
	public function hasValidations() {
		return ($this->validations->count()) ? true : false;
	}	// END: public function hasValidations() {
	
	/*
	 * 
	 */
	public function getValidations() {
		return $this->validations;
	}	// END: public function getValidations() {
	
	/*
	 * 
	 */
	public function getErrors() {
		return $this->errors;
	}	// END: public function getErrors() {
	
	public function processWithSelects($relations) {
		if($this->is_assoc($relations)){
				foreach($relations as $key=>$value){
					if(is_array($value)){
					$relations[$key] = function($query) use ($value) {
							return $query->select($value);
						};
					}
				}
		}
		return $relations;
	}
	
	private function is_assoc($array) {
		return (bool)count(array_filter(array_keys($array), 'is_string'));
	}
}
?>