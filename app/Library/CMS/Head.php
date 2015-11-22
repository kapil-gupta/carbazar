<?php
namespace SmartCarBazar\Library\CMS;

/**
 * Description of Head
 *
 * @author SharmilS
 */
class Head {
	/*	variables	*/
	private $title;
    private $keywords = '';
    private $description = '';
    
	/*
	 * Constructor method
	 */
    public function __construct($title='', $keywords='', $description='') {
		$this->title = $title;
		$this->keywords = $keywords;
		$this->description = $description;
	}	// END: public function __construct($title='', $keywords='', $description='') {
	
	/*
	 * Get method for description property
	 * 
	 * @return  string  $this->description
	 */
	public function getDescription() {
		return $this->description;
	}	// END: public function getDescription() {
	
	/*
	 * Get method for keywords property
	 * 
	 * @return  string  $this->keywords
	 */
	public function getKeywords() {
		return $this->keywords;
	}	// END: public function getKeywords() {
	
	/*
	 * Get method for title property
	 * 
	 * @return  string  $this->title
	 */
	public function getTitle() {
		return $this->title;
	}	// END: public function getTitle() {
	
	/*
	 * Set method for description property
	 * 
	 * @param  string  $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}	// END: public function setDescription($description) {
	
	/*
	 * Set method for keywords property
	 * 
	 * @param  string  $keywords
	 */
	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}	// END: public function setKeywords($keywords) {
	
	/*
	 * Set method for title property
	 * 
	 * @param  string  $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}	// END: public function setTitle($title) {
	
	/*
	 * Method to return the properties of the class in array format
	 * 
	 * @return  array
	 */
	public function toArray() {
		return array(
				'title'=>$this->title,
				'keywords'=>$this->keywords,
				'description'=>$this->description
		);
	}	// END: public function toArray() {
}
?>