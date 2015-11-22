<?php
namespace SmartCarBazar\Library\CMS;

/**
 * Description of DynamicPage
 *
 * @author SharmilS
 */
class PageManager {
	private $action = '';
	private $activePage = '';
	private $activeSection = '';
	private $body = null;
	private $controller = '';
	private $footer = null;
	private $head = null;
	private $header = null;
	private $pageType = '';
	private $template = '';
	
	/*
	 * Constructor method
	 */
	public function __construct($template = '', $controller = '', $action = '') {
		$this->action = $action;
		$this->activePage = '';
		$this->activeSection = '';
		$this->body = new Body();
		$this->controller = $controller;
		$this->footer = new Footer();
		$this->head = new Head();
		$this->header = new Header();
		$this->pageType = '';
		$this->template = $template;
	}	// END: public function __construct($template = '', $controller = '', $action = '') {
	
	/*
	 * Method to check if the neccessary properties of the class have been populated
	 * 
	 * @return  boolean
	 */
	public function isReady() {
		if ($this->body && $this->header && $this->footer && $this->head && $this->template)
			return true;
		else
			return false;
	}	// END: public function isReady() {
	
	/*
	 * Get method for $this->action
	 * 
	 * @return  string  $action
	 */
	public function getAction() {
		return $this->action;
	}	// END: public function getAction() {
	
	/*
	 * Get method for $this->activePage
	 * 
	 * @return  string  $activePage
	 */
	public function getActivePage() {
		return $this->activePage;
	}	// END: public function getActivePage() {
	
	/*
	 * Get method for $this->activeSection
	 * 
	 * @return  string  $activeSection
	 */
	public function getActiveSection($level = null) {
		if(!is_null($level) && isset($this->activeSection[$level])){
			return $this->activeSection[$level];
		}
		return $this->activeSection;
	}	// END: public function getActiveSection() {
	
	/*
	 * Get method for $this->body
	 * 
	 * @return  Body  $body
	 */
	public function getBody() {
		return $this->body;
	}	// END: public function getBody() {
	
	/*
	 * Get method for $this->controller
	 * 
	 * @return  string  $controller
	 */
	public function getController() {
		return $this->controller;
	}	// END: public function getController() {
	
	/*
	 * Get method for $this->footer
	 * 
	 * @return  Footer  $footer
	 */
	public function getFooter() {
		return $this->footer;
	}	// END: public function getFooter() {
	
	/*
	 * Get method for $this->head
	 * 
	 * @return  Head  $head
	 */
	public function getHead() {
		return $this->head;
	}	// END: public function getHead() {
	
	/*
	 * Get method for $this->header
	 * 
	 * @return  Header  $header
	 */
	public function getHeader() {
		return $this->head;
	}	// END: public function getHeader() {
	
	/*
	 * Get method for $this->pageType
	 * 
	 * @return  string  $pageType
	 */
	public function getPageType() {
		return $this->pageType;
	}	// END: public function getPageType() {
	
	/*
	 * Get method for $this->template
	 * 
	 * @return  string  $template
	 */
	public function getTemplate() {
		return $this->template;
	}	// END: public function getTemplate() {
	
	/*
	 * Set method for $this->action
	 * 
	 * @param  string  $action
	 */
	public function setAction($action) {
		$this->action = $action;
	}	// END: public function setAction($action) {
	
	/*
	 * Set method for $this->activePage
	 * 
	 * @param  string  $activePage
	 */
	public function setActivePage($activePage) {
		$this->activePage = $activePage;
	}	// END: public function setActivePage($activePage) {
	
	/*
	 * Set method for $this->activeSection
	 * 
	 * @param  string  $activeSection
	 */
	public function setActiveSection($activeSection, $level = null) {
		if(is_null($level)) {
			$this->activeSection = !is_array($activeSection)
				? array($activeSection)
				: $activeSection;
		}else{
			$this->activeSection[$level] = $activeSection;
		}
	}	// END: public function setActiveSection($activeSection) {
	
	/*
	 * Set method for $this->activeSection
	 * 
	 * @param  string  $activeSection
	 */
	public function pushActiveSection($activeSection) {
		$this->activeSection[] = $activeSection;
	}
	
	/*
	 * Set method for $this->body
	 * 
	 * @param  Body  $body
	 */
	public function setBody($body) {
		$this->body = $body;
	}	// END: public function setBody($body) {
	
	/*
	 * Set method for $this->controller
	 * 
	 * @param  string  $controller
	 */
	public function setController($controller) {
		$this->controller = $controller;
	}	// END: public function setController($controller) {
	
	/*
	 * Set method for $this->footer
	 * 
	 * @param  Footer  $footer
	 */
	public function setFooter($footer) {
		$this->footer = $footer;
	}	// END: public function setFooter($footer) {
	
	/*
	 * Set method for $this->head
	 * 
	 * @param  Head  $head
	 */
	public function setHead($head) {
		$this->head = $head;
	}	// END: public function setHead($head) {
	
	/*
	 * Set method for $this->header
	 * 
	 * @param  Header  $header
	 */
	public function setHeader($header) {
		$this->header = $header;
	}	// END: public function setHeader($header) {

	/*
	 * Set method for Body $title and Head $title at the same time
	 * 
	 * @param  string  $title
	 */	
	public function setTitle($title){
		$this->body->setTitle($title);
		$this->head->setTitle($title);
	}
	
	/*
	 * Set method for $this->pageType
	 * 
	 * @param  string  $pageType
	 */
	public function setPageType($pageType) {
		$this->pageType = $pageType;
	}	// END: public function setPageType($pageType) {
	
	/*
	 * Set method for $this->template
	 * 
	 * @param  string  $template
	 */
	public function setTemplate($template) {
		$this->template = $template;
	}	// END: public function setTemplate($template) {
	
	/*
	 * Method to get all the properties of the class in array format
	 * 
	 * @return  array
	 */
	public function toArray(){
		return array(
			'action' => $this->action,
			'activePage' => $this->activePage,
			'activeSection' => $this->activeSection,
			'body' => $this->body->toArray(),
			'controller' => $this->controller,
			'footer' => $this->footer->toArray(),
			'head' => $this->head->toArray(),
			'header' => $this->header->toArray(),
			'pageType' => $this->pageType,
			'template' => $this->template
		);
	}	// END: public function toArray(){
}
?>