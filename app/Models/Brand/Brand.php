<?php

namespace SmartCarBazar\Models\Brand;



class Brand extends \CommonAttributes {

   
    public function models()
    {
        return $this->hasMany('SmartCarBazar\Models\Model\Model');
    }

}
