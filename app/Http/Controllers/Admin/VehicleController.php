<?php

namespace SmartCarBazar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SmartCarBazar\Http\Requests\StoreVehicleRequest as StoreVehicleRequest;
use SmartCarBazar\Http\Controllers\CorporateController as CorporateController;
use \SmartCarBazar\Models\Vehicle;
use \Lang;
use \SmartCarBazar\Models\Brand\Model as Model;
use \SmartCarBazar\Models\Category as Category;
class VehicleController extends CorporateController {

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $Brands = new Model();
        $Category = new Category();
        $AllBrands = $Brands->getAll();
        //print_r($AllBrands);die;
        $AllCategories = $Category->getAll();
        //print_r($AllCategories);die;
        /* Breadcrumbs */
        $title = "Create Vehicle";
        $this->page->getBody()->addBreadcrumb('Vehicle', '/vehicle');
        $this->page->getBody()->addBreadcrumb('Add');
        /* Breadcrumbs */
        /* Page Maker */
        $this->page->getHead()->setDescription('add area');
        $this->page->getHead()->setKeywords('manage, edit, area, manage area, edit area');
        $this->page->setTitle($title);
        $this->page->getBody()->addToData('Brands', $AllBrands);
        $this->page->getBody()->addToData('Categories', $AllCategories);

        return view($this->viewBase . "." . __FUNCTION__, array('page' => $this->page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRequest $request) {
        /* echo '<pre>';
          print_r($request->all());
          die; */
        $input = $request->only(['name', 'category_id', 'price', 'description', 'model_id', 'is_active', 'meta_title', 'meta_keywords', 'meta_description']);
        $ModelVehicle = new Vehicle();
        $result = $ModelVehicle->add($input);

        if ($result['status']) {
            return redirect(admin_route('vehicle.edit',['id'=>$result['id'],'tab2'=>'show']))->with(array('success' => Lang::get('messages.crud.success', array('action' => 'created'))));
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
        $ModelVehicle = new \SmartCarBazar\Models\Vehicle();
        $vehicle = $ModelVehicle->view($id, 0);
        dd($vehicle);
        /* Breadcrumbs */
        $title = "Edit Vehicle";
        $this->page->getBody()->addBreadcrumb('Vehicle', '/admin/vehicle');
        $this->page->getBody()->addBreadcrumb($vehicle->name, admin_route('vehicle.show',$vehicle->id));
        $this->page->getBody()->addBreadcrumb('Edit');
        /* Breadcrumbs */
        /* Page Maker */
        $this->page->getHead()->setDescription('add area');
        $this->page->getHead()->setKeywords('manage, edit, area, manage area, edit area');
        $this->page->setTitle($title);
        $this->page->getBody()->addToData('Brands', $AllBrands);
        $this->page->getBody()->addToData('Categories', $AllCategories);
        $this->page->getBody()->addToData('Vehicle', $vehicle);


        return view($this->viewBase . "." . __FUNCTION__, array('page' => $this->page));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $ModelVehicle = new \SmartCarBazar\Models\Vehicle();
        $Brands = new \SmartCarBazar\Models\Brand\Model();
        $Category = new \SmartCarBazar\Models\Category();
        $ModelFeatureCategory = new \SmartCarBazar\Models\FeatureCategory();
        $FeatureCategory = $ModelFeatureCategory->getAll();
        //dd($FeatureCategory);
        $AllBrands = $Brands->getAll();
        $AllCategories = $Category->getAll();
        $vehicle = $ModelVehicle->view($id, 0);
        /* Breadcrumbs */
        $title = "Edit Vehicle";
        $this->page->getBody()->addBreadcrumb('Vehicle', '/admin/vehicle');
        $this->page->getBody()->addBreadcrumb($vehicle->name, admin_route('vehicle.show',$vehicle->id));
        $this->page->getBody()->addBreadcrumb('Edit');
        /* Breadcrumbs */
        /* Page Maker */
        $this->page->getHead()->setDescription('add area');
        $this->page->getHead()->setKeywords('manage, edit, area, manage area, edit area');
        $this->page->setTitle($title);
        $this->page->getBody()->addToData('Brands', $AllBrands);
        $this->page->getBody()->addToData('Categories', $AllCategories);
        $this->page->getBody()->addToData('Vehicle', $vehicle);
        $this->page->getBody()->addToData('FeatureCategory', $FeatureCategory);


        return view($this->viewBase . "." . __FUNCTION__, array('page' => $this->page));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVehicleRequest $request, $id) {
        $input = $request->only(['name', 'category_id', 'price', 'description', 'model_id', 'is_active', 'meta_title', 'meta_keywords', 'meta_description']);
        $ModelVehicle = new Vehicle();
        $result = $ModelVehicle->edit($input,$id);

        if ($result['status']) {
            return redirect(admin_route('vehicle.show',$id))->with(array('success' => Lang::get('messages.crud.success', array('action' => 'created'))));
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
