<?php

namespace SmartCarBazar\Models;

use SmartCarBazar\Models\CommonAttributes as CommonAttributes;

class Feature extends CommonAttributes {

    public function vehicle() {
        return $this->belongsToMany('SmartCarBazar\Models\Vehicle','vehicle_features');
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

}
