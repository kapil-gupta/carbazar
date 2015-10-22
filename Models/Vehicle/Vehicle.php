<?php

namespace SmartCarBazar\Models;



class Vehicle extends \BaseModel {

   
    public function model()
    {
        return $this->hasMany('SmartCarBazar\Models\Brand\Model\Model');
    }

}
