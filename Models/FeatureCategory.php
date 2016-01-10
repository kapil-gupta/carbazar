<?php

namespace SmartCarBazar\Models;
use SmartCarBazar\Models\CommonAttributes;

class FeatureCategory extends CommonAttributes {
    public function features() {
        return $this->hasMany('SmartCarBazar\Models\Feature','parent_id');
    }

    public function getAll() {
        return $this::category()->active()->get();
    }
    public function scopeCategory($query)
    {
        return $query->where('type','feature_category');
    }
    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }


}
