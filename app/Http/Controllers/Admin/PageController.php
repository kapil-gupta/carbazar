<?php

namespace SmartCarBazar\Http\Controllers\Admin;

use yajra\Datatables\Datatables;
use \File;
use Illuminate\Http\Request;
use SmartCarBazar\Http\Requests\StorePageRequest;
use SmartCarBazar\Http\Requests\EditPageRequest;
use SmartCarBazar\Http\Requests\ImageUploadRequest;
use SmartCarBazar\Http\Controllers\CorporateController as CorporateController;
use \SmartCarBazar\Models\Page;
use \Lang;
use \SmartCarBazar\Models\Category as Category;

class PageController extends CorporateController {

    public function __construct() {
        parent::__construct();
        $this->page->setActiveSection(array('masters', 'location', 'area'));
    }

    public function getList() {
        $ModelPage = new \SmartCarBazar\Models\Vehicle();

        $records = $ModelPage::with('category', 'model', 'model.brand')->select('*');
        return Datatables::of($records)
                        ->addColumn('action', function ($records) {
                            return '<a href="' . admin_route('vehicle.edit', $records->id) . '" class="btn btn-xs default btn-editable"><i class="fa fa-pencil"></i> Edit</a>';
                        })
                        ->editColumn('id', 'ID: {{$id}}')
                        ->setRowId('id')
                        ->setRowClass(function ($records) {
                            return $records->id % 2 == 0 ? 'even' : 'odd';
                        })
                        ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ModelPage = new \SmartCarBazar\Models\Vehicle();
        //$page = $ModelPage->view($id, 0);
        /* Breadcrumbs */
        $title = "Vehicle";
        $this->page->getBody()->addBreadcrumb('Vehicle', '/admin/vehicle');
        //$this->page->getBody()->addBreadcrumb($page->name, admin_route('vehicle.show', $page->id));
        //$this->page->getBody()->addBreadcrumb('Edit');
        /* Breadcrumbs */
        /* Page Maker */
        $this->page->getHead()->setDescription('Vehicle listing');
        $this->page->getHead()->setKeywords('manage, edit, area, manage area, edit area');
        $this->page->setTitle($title);
        //$this->page->getBody()->addToData('Vehicle', $page);

        return view($this->viewBase . "." . __FUNCTION__, array('page' => $this->page));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $Category = new Category();
        $AllCategories = $Category->getPagesCategory();
        //print_r($AllCategories);die;
        /* Breadcrumbs */
        $title = "Create Page";
        $this->page->getBody()->addBreadcrumb('Pages', '/page');
        $this->page->getBody()->addBreadcrumb('Add');
        /* Breadcrumbs */
        /* Page Maker */
        $this->page->getHead()->setDescription('add page');
        $this->page->getHead()->setKeywords('manage, edit, page, manage page, edit page');
        $this->page->setTitle($title);
        $this->page->getBody()->addToData('Categories', $AllCategories);

        return view($this->viewBase . "." . __FUNCTION__, array('page' => $this->page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request) {
        $input = $request->only(['name', 'parent_id','description',  'is_active', 'meta_title', 'meta_keywords', 'meta_description']);
        $ModelPage = new Page();
        $result = $ModelPage->add($input);

        if ($result['status']) {
            return redirect(admin_route('page.edit', ['id' => $result['id'], 'tab' => 'images']))->with(array('success' => Lang::get('messages.crud.success', array('action' => 'created'))));
        } else {
            return back()->withErrors(['error' => $result['msg']]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $ModelPage = new Page();
        $page = $ModelPage->view($id, 0);
        /* Breadcrumbs */
        $title = "Page";
        $this->page->getBody()->addBreadcrumb('Page',  admin_route('page.index'));
        $this->page->getBody()->addBreadcrumb($page->name, admin_route('page.show', $page->id));
        $this->page->getBody()->addBreadcrumb('Edit');
        /* Breadcrumbs */
        /* Page Maker */
        $this->page->getHead()->setDescription('add area');
        $this->page->getHead()->setKeywords('manage, edit, area, manage area, edit area');
        $this->page->setTitle($title);
        $this->page->getBody()->addToData('Page', $page);

        return view($this->viewBase . "." . __FUNCTION__, array('page' => $this->page));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request) {
        $Category = new Category();
        $AllCategories = $Category->getPagesCategory();
        $ModelPage = new Page(); 
        $page = $ModelPage->view($id, 0);
         
        /* Breadcrumbs */
        $title = "Edit Page";
        $this->page->getBody()->addBreadcrumb('Vehicle', admin_route('page.index'));
        $this->page->getBody()->addBreadcrumb($page->name, admin_route('page.show', $page->id));
        $this->page->getBody()->addBreadcrumb('Edit');
        /* Breadcrumbs */
        /* Page Maker */
        $this->page->getHead()->setDescription('add page');
        $this->page->getHead()->setKeywords('manage, edit, page, manage page, edit page');
        $this->page->setTitle($title);
        $this->page->getBody()->addToData('Categories', $AllCategories);
        $this->page->getBody()->addToData('Page', $page);
        return view($this->viewBase . "." . __FUNCTION__, array('page' => $this->page));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPageRequest $request, $page_id) {
        $input = $request->only(['name', 'parent_id','description',  'is_active', 'meta_title', 'meta_keywords', 'meta_description']);
        $ModelPage = new Page();
        $result = $ModelPage->edit($page_id, $input);
        if ($result['status'] && !isset($result['tab'])) {
            return redirect(admin_route('vehicle.show', $page_id))->with(array('success' => Lang::get('messages.crud.success', array('action' => 'updated'))));
        } elseif (!$result['status'] && isset($result['tab'])) {
            return redirect(admin_route('vehicle.edit', ['id' => $result['id'], 'tab' => $result['tab']]))->withErrors(['error' => $result['error']]);
        } else {
            return back()->withErrors(['error' => $result['msg']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
