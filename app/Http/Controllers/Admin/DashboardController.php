<?php

namespace SmartCarBazar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SmartCarBazar\Http\Requests;
use SmartCarBazar\Http\Controllers\CorporateController as CorporateController;

class DashboardController extends CorporateController {

    public function __construct() {
        parent::__construct();
        $this->page->setActiveSection(array('masters', 'location', 'area'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $title = "Create Vehicle";
        $this->page->getBody()->addBreadcrumb('Areas', '/area');

        $this->page->getBody()->addBreadcrumb('Create');
        /* Breadcrumbs */

        /* Page Maker */
        $this->page->getHead()->setDescription('add area');
        $this->page->getHead()->setKeywords('manage, edit, area, manage area, edit area');
        $this->page->setTitle($title);

        return view("admin.createtemplate" , array('page' => $this->page)); //
    }

}
