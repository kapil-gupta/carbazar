<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PageCategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /**
         * Seed the Feture type and feature data
         */
        SmartCarBazar\Models\CommonAttributes::buildTree([
            ['name' => 'About Us', 'slug' => 'about-us', 'is_active' => 1, 'type' => 'page'],
            ['name' => 'Contact Us', 'slug' => 'contact-us', 'is_active' => 1, 'type' => 'page']
        ]);
    }

}
