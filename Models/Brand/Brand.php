<?php

namespace SmartCarBazar\Models;
use SmartCarBazar\Models\CommonAttributes as CommonAttributes;

class Brand extends CommonAttributes {
    public function models() {
        return $this->hasMany('SmartCarBazar\Models\Model\Model');
    }

    public function getAll() {
        return $this::brand()->active()->get();
    }
    public function scopeBrand($query)
    {
        return $query->where('type','brand');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }


}
