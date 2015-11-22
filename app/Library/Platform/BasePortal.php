<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlatformPortal
 *
 * @author SharmilS
 */

namespace SmartCarBazar\Library\Platform;

use Request;
use City;
use Session;
use Config;
use Ip;

class BasePortal {
    
    protected $alias = "";
            
    public function __construct()
    {
    }
    
    public function getAlias()
    {
        return $this->alias;
    }
    
    protected function setAlias($alias)
    {
        $this->alias = $alias;
    }
   
}

?>
