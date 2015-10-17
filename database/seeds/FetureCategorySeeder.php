<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FetureCategorySeeder extends Seeder {

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
            ['name' => 'Fuel Type', 'slug' => 'fuel-type', 'is_active' => 1, 'type' => 'feature_category',
                'children' => [
                    ['name' => 'Petrol', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Diesel', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'LPG', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'CNG', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Electric', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                ]
            ],
            ['name' => 'Transmission', 'slug' => 'transmission', 'is_active' => 1, 'type' => 'feature_category',
                'children' => [
                    ['name' => 'Manual', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Automatic', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                ]
            ],
            ['name' => 'Color', 'slug' => 'color', 'is_active' => 1, 'type' => 'feature_category',
                'children' => [
                    ['name' => 'Black', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Green', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'White', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Blue', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Maroon', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Grey', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Bronze', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Brown', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Orange', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                    ['name' => 'Red', 'slug' => null, 'is_active' => 1, 'type' => 'feature'],
                ]
            ]
        ]);
        /**
         * Seed the category data
         * 
         */
        SmartCarBazar\Models\CommonAttributes::buildTree([
            ['name' => 'Cars', 'slug' => null, 'is_active' => 1, 'type' => 'category'],
            ['name' => 'Truck', 'slug' => null, 'is_active' => 1, 'type' => 'category'],
            ['name' => 'Bike/Scooter', 'slug' => null, 'is_active' => 1, 'type' => 'category'],
            ['name' => 'Cycle', 'slug' => null, 'is_active' => 1, 'type' => 'category'],
        ]);
    }

}
