<?php

namespace SmartCarBazar\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use \Exception as Exception;

class Seo extends BaseModel {

    use SoftDeletes;

    protected $table = 'seo';
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $fillable = ['name', 'seoable_id', 'seoable_type', 'title', 'keyword', 'description', 'is_active', 'created_by', 'updated_by'];
    public $timestamps = true;

    public function seoable() {
        return $this->morphTo();
    }

}
