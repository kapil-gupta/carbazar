<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Error
 *
 * @author SharmilS
 */
class Error implements \Illuminate\Support\Contracts\ArrayableInterface {
    //put your code here
    
    private $code = 0;
    private $message = '';
    
    public function __construct($message, $code = 0) {
        $this->message = $message;  
        $this->code = $code;
    }
    
    public function toArray(){
        return array('code'=>$this->code,'message'=>$this->message);
    }
}

?>
