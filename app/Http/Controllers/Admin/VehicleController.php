<?php

namespace SmartCarBazar\Http\Controllers\Admin;

use \File;
use Illuminate\Http\Request;
use SmartCarBazar\Http\Requests\StoreVehicleRequest;
use SmartCarBazar\Http\Requests\EditVehicleRequest;
use SmartCarBazar\Http\Requests\ImageUploadRequest;
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
            return redirect(admin_route('vehicle.edit',['id'=>$result['id'],'tab'=>'images']))->with(array('success' => Lang::get('messages.crud.success', array('action' => 'created'))));
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
    public function edit($id,Request $request) {
        $tab = $request->get('tab',null);
        $ModelVehicle = new \SmartCarBazar\Models\Vehicle();
        $Brands = new \SmartCarBazar\Models\Brand\Model();
        $Category = new \SmartCarBazar\Models\Category();
        $ModelFeatureCategory = new \SmartCarBazar\Models\FeatureCategory();
        $FeatureCategory = $ModelFeatureCategory->getAll();
        //dd($FeatureCategory);
        $AllBrands = $Brands->getAll();
        foreach($AllBrands as $brand) {
          $BrandList[$brand->id] =$brand->brand->name.' '.$brand->name;    
        }
        $AllCategories = $Category->getAll();
        $vehicle = $ModelVehicle->view($id, 0);
        $vehicleFeatures = $vehicle->features()->lists('feature_id','feature_id')->toArray();
        //echo '<pre>';print_r(($vehicleFeatures->lists('feature_id')->toArray()));exit;
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
        $this->page->getBody()->addToData('Brands', $BrandList);
        $this->page->getBody()->addToData('Categories', $AllCategories);
        $this->page->getBody()->addToData('Vehicle', $vehicle);
        $this->page->getBody()->addToData('FeatureCategory', $FeatureCategory);
        $this->page->getBody()->addToData('vehicleFeatures', $vehicleFeatures);
        $this->page->getBody()->addToData('tab', $tab);

        return view($this->viewBase . "." . __FUNCTION__, array('page' => $this->page));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditVehicleRequest $request, $vehicle_id) {
        //echo '<pre>'; print_r($request->all());exit;
        $input = $request->only(['name', 'category_id', 'price', 'description', 'model_id', 'is_active', 'meta_title', 'meta_keywords', 'meta_description']);
        $checkbox_name_ids = $request->get('check_validate');
        $radio_name_ids = $request->get('radio_validate');
        //$temp = array_merge($checkbox_name_ids,$radio_name_ids);
        $features = null;
        if(0 < count($checkbox_name_ids)){
            foreach($checkbox_name_ids as $id){
                if( $features!='')
                $features.=','.implode(',',$request->get('features_checkbox_'.$id));
                else
                    $features.=implode(',',$request->get('features_checkbox_'.$id));
            }
        }
        //echo $features.'<br>';exit;
        if(0 < count($radio_name_ids)){
            $temp = [];
            foreach($radio_name_ids as $id){
                $temp[]=$request->get('features_radio_'.$id);
            }
             $features.=','.implode(',',$temp);
        }
        $input['features']  =$features;
        //echo '<pre>'; print_r($input);exit;
        $ModelVehicle = new Vehicle();
        $result = $ModelVehicle->edit($vehicle_id,$input);

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
    public  function ImageUpload(ImageUploadRequest $request){
        $file = $request->file('file'); 
        $extension = File::extension($file->getClientOriginalName());
        //$directory = VEHICLE_IMAGE_PATH.'\\'.sha1(time());
        $filename = sha1(time().time()).".{$extension}";
        $upload_success = $request->file('file')->move(VEHICLE_IMAGE_PATH, $filename);
        //$upload_success = Input::upload('file', $directory, $filename);

        if( $upload_success ) {
        	return \Response::json('success', 200);
        } else {
        	return \Response::json('error', 400);
        }
    }

}
