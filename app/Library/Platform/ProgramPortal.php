<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DynamicPortal
 *
 * @author SharmilS
 */

namespace SmartCarBazar\Library\Platform;

class ProgramPortal extends BasePortal {
    //put your code here
    
    private $programPortal;

    public function __construct($programPortal)
    {
        parent::__construct();
        $this->programPortal = $programPortal;
        $this->setAlias($this->programPortal->alias);
        $this->setCitySessionByIpAddress();
    }
    
    public function getProgramPortal()
    {
        return $this->programPortal;
    }
    
    public function setCityId($city_id)
    {
        
    }
    
    public function exists()
    {
        return ($this->programPortal) ? true : false;
    }
    
}

?>
