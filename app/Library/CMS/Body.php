<?php
namespace SmartCarBazar\Library\CMS;

use \Auth as Auth;

/**
 * Description of Body
 *
 * @author SharmilS
 */
class Body {
	private $title;
	private $breadcrumbs;
	private $data;
	private $menu;
	private $modules;
	
	/*
	 * Contructor Method
	 */
	public function __construct($data = array()) {
		$this->data = $data;
		$this->menu = $this->modules = $this->breadcrumbs = array();
	}	// END: public function __construct($data = array()) {
	
	/*
	 * Method to add a key-value pair to $this->data
	 * 
	 * @param  string  $key
	 * @param  string/object/arrray  $value
	 */
	public function addToData($key, $value) {
		$this->data[$key] = $value;
	}	// END: public function addToData($key, $value) {

	public function getBreadcrumbs(){
		return $this->breadcrumbs;
	}	
	
	/*
	 * Get method for $this->data
	 * 
	 * @return  array  $this->data
	 */
	public function getData() {
		return $this->data;
	}	// END: public function getData() {
	
	/*
	 * Method to get value corresponding to a key from $this->data
	 * 
	 * @param  string  $key
	 * 
	 * @return  string/object/array/null i.e. value corresponding to the 'key'
	 */
	public function getDataByKey($key) {
		if (array_key_exists($key, $this->data))
			return $this->data[$key];
		else
			return null;
	}	// END: public function getDataByKey($key) {
	
	/*
	 * Get method for $this->menu
	 * 
	 * @return  array  $this->menu
	 */
	public function getMenu() {
		return $this->menu;
	}	// END: public function getMenu() {
	
	/*
	 * Get method for $this->title
	 * 
	 * @return  string  $this->title
	 */
	public function getTitle() {
		return $this->title;
	}	// END: public function getTitle() {
	
	/*
	 * Get method for $this->modules
	 * 
	 * @return  array  $this->modules
	 */
	public function getModules() {
		return $this->modules;
	}	// END: public function getModules() {
	
	public function setBreadcrumbs($breadcrumbs){
		$this->breadcrumbs = $breadcrumbs;
	}
	
	public function addBreadcrumb($title, $url = '', $permission = ''){
		if($permission){
			if(Auth::check() && !Auth::user()->can($permission)){
				$url = '';
			}
		}
		$this->breadcrumbs[] = array('title'=>$title, 'url'=>$url);
	}	
	
	/*
	 * Set method for $this->data
	 * 
	 * @param  array  $data
	 */
	public function setData($data) {
		$this->data = $data;
	}	// END: public function setData($data) {
	
	/*
	 * Set method for $this->menu
	 * 
	 * @param  array  $menu
	 */
	public function setMenu($menu) {
		$this->menu = $menu;
	}	// END: public function setMenu($menu) {
	
	/*
	 * Set method for $this->title
	 * 
	 * @param  string  $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}
	
	/*
	 * Set method for $this->modules
	 * 
	 * @param  array  $modules
	 */
	public function setModules($modules) {
		$this->modules = $modules;
	}	// END: public function setModules($modules) {
	
	/*
	 * Method to get all the properties of the class in array format
	 * 
	 * @return  array
	 */
	public function toArray() {
		return array('data'=>$this->data, 'modules'=>$this->modules, 'menu'=>$this->menu, 'breadcrumbs'=>$this->breadcrumbs);
	}	// END: public function toArray() {
}
?>