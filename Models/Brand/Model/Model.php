<?php

namespace SmartCarBazar\Models\Brand;

use SmartCarBazar\Models\CommonAttributes as CommonAttributes;

class Model extends CommonAttributes {
    public function varients() {
        return $this->hasMany('SmartCarBazar\Models\Model\Varient');
    }
    public function brand() {
        return $this->hasOne('SmartCarBazar\Models\Brand','id','parent_id');
    }

    public function getAll() {
        return $this::model()->active()->get();
    }

    public function scopeModel($query) {
        return $query->where('type', 'model');
    }

    public function scopeActive($query) {
        return $query->where('is_active', 1);
    }

}
