<?php
namespace SmartCarBazar\Library\CMS;

/**
 * Description of Footer
 *
 * @author SharmilS
 */
class Footer {
	private $copyright;
	private $elements;
	private $menu;
	private $powered;
	
	/*
	 * Contructor method
	 */
	public function __construct() {
		$this->powered = $this->copyright = '';
		$this->menu = $this->elements = array();
	}	// END: public function __construct() {
	
	/*
	 * Get method for $this->copyright
	 * 
	 * @return  string  $copyright
	 */
	public function getCopyright() {
		return $this->copyright;
	}	// END: public function getCopyright() {
	
	/*
	 * Get method for $this->elements
	 * 
	 * @return  array  $elements
	 */
	public function getElements() {
		return $this->elements;
	}	// END: public function getElements() {
	
	/*
	 * Get method for $this->menu
	 * 
	 * @return  array  $menu
	 */
	public function getMenu() {
		return $this->menu;
	}	// END: public function getMenu() {
	
	/*
	 * Get method for $this->powered
	 * 
	 * @return  string  $powered
	 */
	public function getPowered() {
		return $this->powered;
	}	// END: public function getPowered() {
	
	/*
	 * Set method for $this->copyright
	 * 
	 * @param  string  $copyright
	 */
	public function SetCopyright($copyright) {
		$this->copyright = $copyright;
	}	// END: public function SetCopyright($copyright) {
	
	/*
	 * Set method for $this->elements
	 * 
	 * @param  array  $elements
	 */
	public function setElements($elements) {
		$this->elements = $elements;
	}	// END: public function setElements($elements) {
	
	/*
	 * Set method for $this->menu
	 * 
	 * @param  array  $menu
	 */
	public function setMenu($menu) {
		$this->menu = $menu;
	}	// END: public function setMenu($menu) {
	
	/*
	 * Set method for $this->powered
	 * 
	 * @return  string $powered
	 */
	public function setPowered($powered) {
		$this->powered = $powered;
	}	// END: public function setPowered($powered) {
	
	/*
	 * Method to get all the properties of the class in array format
	 * 
	 * @return  array
	 */
	public function toArray() {
		return array(
			'copyright'=>$this->copyright,
			'elements'=>$this->elements,
			'menu'=>$this->menu,
			'powered'=>$this->powered
		);
	}	// END: public function toArray() {
}
?>