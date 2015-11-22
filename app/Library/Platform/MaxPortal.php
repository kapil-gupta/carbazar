<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MaxPortal
 *
 * @author SharmilS
 */

namespace SmartCarBazar\Library\Platform;

class MaxPortal extends BasePortal {
    //put your code here
    
    public function __construct()
    {
        parent::__construct();
        $this->setAlias("www");
        $this->setCitySessionByIpAddress();
    }
}

?>
