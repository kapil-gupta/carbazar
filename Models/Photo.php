<?php

namespace SmartCarBazar\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use \Exception as Exception;
use \Image as Image;

class Photo extends BaseModel {

    use SoftDeletes;

    
    protected $table = 'photos';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $fillable = ['name', 'imageable_id', 'imageable_type', 'is_active', 'created_by', 'updated_by'];
    public $timestamps = true;

     

    public function imageable() {
        return $this->morphTo();
    }

    private function getNewPhotoName($id) {
        return $id . "_" . time();
    }

    public function getAll() {
        return $this::category()->active()->lists('name', 'id');
    }

    public function scopeFeature($query) {
        return $query->where('type', 'feature');
    }

    public function scopeActive($query) {
        return $query->where('is_active', 1);
    }

    public function add($data) {
        $photo = $data['photo'];
        unset($data['photo']);
        $returnResponse = ['status' => 1, 'code' => null, 'msg' => null];
        try {
            $extension = $photo->getClientOriginalExtension();
            $file_name = $this->getNewPhotoName($data['imageable_id']);
            $file_name.='.' . $extension;
            $isUploaded = Image::make($photo)->save(config('assets.images.paths.original') . $file_name);
            $data['name'] = $file_name;
            $pic = self::create($data);
            if ($isUploaded && $pic) {
                $returnResponse['status'] = 1;
                $returnResponse['id'] = $pic->id;
                $returnResponse['name'] = $file_name;
                $returnResponse['size'] = filesize(config('assets.images.paths.original') . $file_name);
            } else {
                $returnResponse['status'] = 0;
            }
        } catch (Exception $e) {
            $returnResponse['status'] = 0;
            $returnResponse['code'] = $e->getCode();
            //$returnResponse['msg'] = 'There is some error Please try After some time';
            $returnResponse['msg'] = $e->getMessage();
        }
        return $returnResponse;
    }

}
