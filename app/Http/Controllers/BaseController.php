<?php

namespace SmartCarBazar\Http\Controllers;
use \Illuminate\Http\Request as Request;
class BaseController extends Controller {

    /**
     *
     * @var string 
     */
    protected $platform = null;

    /**
     * Constructor function
     */
    public function __construct() {
        
        
    }

    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

}

?>