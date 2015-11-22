<?php

namespace SmartCarBazar\Library\CMS;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Header
 *
 * @author SharmilS
 */
class Header {
    //put your code here
    
    private $logo;
    private $elements;
    private $menu;
    
    public function __construct(){
        $this->logo = '';
        $this->menu = $this->elements = array();
    }
	
	public function getLogo(){
		return $this->logo;		
	}
	
	public function setLogo($logo){
		$this->logo = $logo;
	}
	
	public function getElements(){
		return $this->elements;
	}
	
	public function setElements($elements){
		$this->elements = $elements;
	}
	
	public function getMenu(){
		return $this->menu;
	}
	
	public function setMenu($menu){
		$this->menu = $menu;
	}
    
    public function toArray(){
        return array(
            'menu'=>$this->menu,
            'logo'=>$this->logo,
            'elements'=>$this->elements
                );
    }
    
}

?>
