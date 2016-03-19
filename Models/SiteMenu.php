<?php

namespace SmartCarBazar\Models;
use SmartCarBazar\Models\CommonAttributes as CommonAttributes;

class SiteMenu extends CommonAttributes {
    
    public function scopePage($query)
    {
        return $query->where('type','page');
    }
    
  
    public function scopeActive($query)
    {
        return $query->where('is_active',1);
    }


}
