<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PortalManager
 *
 * @author SharmilS
 */

namespace SmartCarBazar\Library\Platform;

use \Illuminate\Http\Request as Request;

class PlatformFactory {
	//put your code here
	
	private $base_url;
	private static $platformTypes = array('corporate'=>1,'program'=>2);
	private $platformType = 3;
	private $portal = null;
	public  $request;
	protected static $responseTypes = array(1=>'www',2=>'m',3=>'api');
	protected $responseType = 1;
	
	//Not Implemented
	//protected static $contentTypes = array(1=>'.html','2'=>'.json',3=>'.xml');
	//protected $contentType = 1;
	
	public function __construct($request) {
		$this->base_url = config('app.base_url');
		$this->processURL();
		$this->processRoutePrefix();
                $this->request = $request;
                 print_r($request);die;
        }
	
	private function processURL() {
		$subdomain = array();
		
		if($this->isBaseURL()) {
			$temp = explode('.', str_replace('.' .$this->base_url, '',  $this->request->server('HTTP_HOST')));
			if (count($temp) == 1)
				$subdomain = $temp;
			else
				$subdomain[] = implode('.', $temp);
                        if(array_search(strtolower($subdomain[0]), array_map('strtolower', config('app.static_subdomains'))) !== FALSE) {
				$this->platformType = self::$platformTypes['corporate'];
				$this->portal = new CorporatePortal($subdomain[0]);
			}
			elseif($subdomain[0] == 'www') {
				$this->platformType = self::$platformTypes['max'];
				$this->portal = new MaxPortal();
			}
			else {
				die('here');
			}
		}
		 
	}
	
	public function isBaseURL() {
           
		return (stripos($this->request->server('HTTP_HOST'), $this->base_url) >= 0) ? true : false;
	}
	
	public function isCustomURL() {
	   return !$this->isBaseURL();
	}
	
	public function getPlatformType() {
		return $this->platformType;
	}
	
	public function getPortal() {
		return $this->portal;
	}
	
	public function isMobile() {
		return ($this->responseType == 2)? true : false;
	}
	
	public function isApi() {
		return ($this->responseType == 3)? true : false;
	}
	
	public function isWeb() {
		return ($this->responseType == 1)? true : false;
	}
	
	public function getResponseType() {
		return $this->responseType;
	}
	
	protected function processRoutePrefix() {
		if(array_search($this->request->segment(1),self::$responseTypes)) {
			$this->responseType = array_search($this->request->segment(1),self::$responseTypes);
		}
		else
			$this->responseType = array_search('www',self::$responseTypes);

		if($this->isApi())
			config('session.driver','array');
		//Config::set('session.cookie',$this->portal->getAlias()."_session");
	}
}
?>