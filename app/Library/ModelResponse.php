<?php
/**
 * Description of ModelResponse
 *
 * @author SharmilS
 */

namespace SmartCarBazar\Library;

use \Illuminate\Support\MessageBag as MessageBag;

class ModelResponse implements \Illuminate\Support\Contracts\ArrayableInterface {

    private $error;
    private $validations;
    private $data;
    private $statusCode = 200;
    
    public function __construct($data = array(), $validations = array(), $error = null, $statusCode = 200) {
        $this->data = $data;
        
        if(is_array($validations)) {
            $this->validations = new MessageBag($validations);
        } else {
            $this->validations = $validations;
        }
        
        if($error instanceof Error) {
            $this->error[] = $error;
        } else {
            $this->error = null;
        }
        
        $this->statusCode = $statusCode;
        
    }
    
    public function setData($data) {
        $this->data = $data;
    }
    
    public function getData() {
        return $this->data;
    }
    
    public function setError($error, $statusCode = 500, $clearData = true) {
        if($error instanceof Error) {
            $this->error = $error;
        } else {
            $this->error = null;
        }
        $this->statusCode = $statusCode;
        if($clearData) {
            $this->data = array();
        }
    }
    
    public function getError() {
        return $this->error;
    }
    
    public function setValidations($validations) {
        if(is_array($validations)) {
            $this->validations = new MessageBag($validations);
        } elseif ($validations instanceof MessageBag ) {
            $this->validations = $validations;
        }
        else {
            $this->validations = new MessageBag((array)$validations);
        }
    }
    
    public function getValidations() {
        return $this->validations;
    }
    
    public function getStatusCode() {
        return $this->status_code;
    }
    
    public function hasError() {
        return ($this->error)? true: false;
    }
    
    public function hasData() {
        return ($this->data)? true: false;
    }
    
    public function hasValidations() {
        return ($this->validations->count())? true: false;
    }
    
    public function toArray() {        
        $response = array();
        
        if($this->hasData()) {
            $response['data'] = $this->data;
        }
        
        if($this->hasError()) {
            $response['error'] = $this->error->toArray();
        }        
        if($this->hasValidations()) {
            $response['validations'] = $this->validations->toArray();
        }
        return $response;
    }
}

?>
