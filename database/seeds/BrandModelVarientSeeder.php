<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BrandModelVarientSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //DB::table('common_attributes')->delete();
        /**
         * Seed the Feture type and feature data
         */
        /*
        SmartCarBazar\Models\CommonAttributes::buildTree([
            ['name' => 'Body Type', 'slug' => 'body-type', 'is_active' => 1, 'type' => 'feature_category',
                'children' => [
                    ['name' => 'HatcBack', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'SUV', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Sedan', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Luxury', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Van/Minivan', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'MPV/MUV', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                ]
            ],
            
            
            
        ]);
         * 
         */
        $str = file_get_contents(__DIR__.'\data.json');
        $json = json_decode($str, true);
        $insert_array=[];
        foreach ($json as $brand => $brand_array) {
            $model_array=[];
            if(is_array($brand_array) && count($brand_array) >0){
                foreach ($brand_array as $model) {
                    
                    $varient_array = [] ;
                    if(is_array($model['inner']) && count($model['inner']) >0){
                            foreach ($model['inner'] as $varient) {
                                $varient_array[] =['name' => ucfirst(trim($varient['text'])), 'slug' => strtolower(str_replace(' ','-',trim($model['text']))), 'is_active' => 1, 'type' => 'varient'];
                            }
                    }
                    $input = array_map("unserialize", array_unique(array_map("serialize", $varient_array)));
                    
                    $model_array[] =['name' => ucfirst(trim($model['text'])), 'slug' => strtolower(str_replace(' ','-',trim($model['text']))), 'is_active' => 1, 'type' => 'model',
                                        'children' => $input
                                    ];
                }
            }
            $insert_array[] =['name' => ucfirst($brand), 'slug' => strtolower($brand), 'is_active' => 1, 'type' => 'brand',
                            'children' => $model_array
                            ];
        }
        
        SmartCarBazar\Models\CommonAttributes::buildTree($insert_array);
        
    }// run end

}//class end
