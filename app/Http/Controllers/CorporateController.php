<?php

namespace SmartCarBazar\Http\Controllers;

use \Auth as Auth;
use SmartCarBazar\Library\CMS\PageManager as PageManager;

class CorporateController extends BaseController {

    use \Illuminate\Console\AppNamespaceDetectorTrait;

    /** @type null|this varibale is used to contain a resource server object for oauth reqeusts */
    protected $resourceServer = null;
    protected $page = null;

    /**
     * 
     * @var string 
     */
    protected $template = 'admin';

    /**
     *
     * @var string 
     */
    protected $viewBase = '';

    /**
     * Setup the resource server for oauth request.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->page = new PageManager($this->template);
        $this->page->setActivePage(str_replace("controller", "", strtolower(substr(get_class(), strrpos(get_class(), "\\") + 1))));
        $this->page->getBody()->addBreadcrumb('Home', url('admin/dashboard'));
        $this->viewBase = str_replace("\\", ".", str_replace("\controllers", "", strtolower(get_called_class())));
        $this->viewBase = str_replace("controller", "", $this->viewBase);
        $this->viewBase = str_replace(strtolower(str_replace("\\", "", $this->getAppNamespace()) . ".http."), "", $this->viewBase);
    }

    public function getTemplate() {
        return $this->template;
    }

// END: public function __construct() {

    /**
     * This function is used by different methods in controller to restrict
     * user access by checking the passed object and object id
     * 
     * @param string $permission permisson passed by function
     * @param object $obj An object of a model
     * @param int $obj_id object id of model ie primary key
     * 
     * @return object
     */
    protected function access($permission, $obj = null, $obj_id = 0) {
        $response = null;

        if ($obj_id) {
            $response = $obj->find($obj_id);
            if (!$response)
                App::abort(404, Lang::get('messages.errors.corporate.missing'));
        }

        if (!(Auth::check() && Auth::user()->can($permission)))
            App::abort(403, Lang::get('messages.errors.corporate.access', array('section' => 'requested')));

        if ($response) {
            if (!(Auth::user()->is('CRM User') || Auth::user()->is_super || Auth::user()->is('Loylty Admin'))) {
                if (!$obj->access($obj_id, Auth::user()->corporate_id))
                    App::abort(403, Lang::get('messages.errors.corporate.access', array('section' => 'requested')));
            }
        }


        return $response;
    }

// END: protected function access($permission, $obj = null, $obj_id = 0){
}

?>