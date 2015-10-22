<?php

namespace SmartCarBazar\Models\Brand\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Varient extends \BaseModel {

    use SoftDeletes;

    protected $table = 'vehicle_varient';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $fillable = ['name', 'is_active', 'created_by', 'updated_by','model_id'];
    public $timestamps = true;
    //protected  $hidden = ['deleted_at'];
    public function models()
    {
        return $this->hasMany('SmartCarBazar\Models\Model\Model');
    }

}
