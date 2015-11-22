<?php

namespace SmartCarBazar\Models;
use SmartCarBazar\Models\CommonAttributes as CommonAttributes;

class Category extends CommonAttributes {
    public function models() {
        return $this->hasMany('SmartCarBazar\Models\Model\Model');
    }

    public function getAll() {
        return $this::category()->active()->lists('name','id');
    }
    public function scopeCategory($query)
    {
        return $query->where('type','category');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }


}
