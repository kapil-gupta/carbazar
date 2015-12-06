<?php

namespace SmartCarBazar\Http\Controllers\Admin;

use \File;
use Illuminate\Http\Request;
use SmartCarBazar\Http\Requests\StoreVehicleRequest;
use SmartCarBazar\Http\Requests\EditVehicleRequest;
use SmartCarBazar\Http\Requests\PhotoUploadRequest;
use \SmartCarBazar\Models\Vehicle;
use \Lang;
use SmartCarBazar\Http\Controllers\CorporateController as CorporateController;
use SmartCarBazar\Models\Photo;

class PhotoController extends CorporateController {

    public function save(PhotoUploadRequest $request) {
        $input = $request->only(['imageable_id', 'imageable_type']);
        $input['photo'] = $request->file('file');
        $ModelPhoto = new Photo();
        $response = $ModelPhoto->add($input);
        return response()->json($response);
    }

    public function getImage(Request $request,$imageable_id,$imageable_type) {
        //\DB::enableQueryLog();
        $ModelVehicle = new Vehicle();
        $Vehicle = $ModelVehicle->find($imageable_id);
        $photos = $Vehicle->photos;
        //print_r(\DB::getQueryLog());exit;
        $result = array();
        //$files = scandir($storeFolder);                 //1
            foreach ($photos as $file) {
                    $obj['id'] = $file->id;
                    $obj['name'] = $file->name;
                    $obj['size'] = filesize(config('assets.images.paths.original'). $file->name);
                    $result[] = $obj;
            }
        
        return response()->json($result);
    }
    public function delete(Request $request,$imageable_id) {
        $ModelPhoto = new Photo();
        $response = $ModelPhoto->destroy($imageable_id);
         
        return response()->json($response);
    }

}
