<?php

use Pingpong\Menus\MenuFacade as Menu;
use SmartCarBazar\Models\SiteMenu as ModelMenu;

Menu::create('navbar', function($menu) {
    $menu->url('/', 'Home');
    $menuAll = ModelMenu::roots()->page()->active()->get();

    foreach ($menuAll as $parent) {
        $childrens = $parent->children()->get();
        if (0 < count($childrens)) {
            $menu->dropdown($parent->name, function ($sub) use($childrens) {
                foreach($childrens as $child){
                $sub->url($child->slug, $child->name);
                }
            });
        } else {
            $menu->url($parent->slug, $parent->name);
        }
    }
   
    $menu->setPresenter('SmartCarBazar\Support\MainMenuPresenter');
});
