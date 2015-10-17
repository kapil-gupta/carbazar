<?php

namespace SmartCarBazar\Models\Brand\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends \BaseModel {

    use SoftDeletes;

    protected $table = 'vehicle_brand';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $fillable = ['name', 'is_active', 'created_by', 'updated_by'];
    public $timestamps = true;
    //protected  $hidden = ['deleted_at'];
    public function models()
    {
        return $this->hasMany('SmartCarBazar\Models\Model\Varient\Varient');
    }

}
