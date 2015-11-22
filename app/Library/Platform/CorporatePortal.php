<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StaticPlatform
 *
 * @author SharmilS
 */

namespace SmartCarBazar\Library\Platform;

class CorporatePortal extends BasePortal {
	
    public function __construct($alias) {
        parent::__construct();
        $this->setAlias($alias);
    }
}

?>
