<?php


namespace App\Services;


use App\Menu;

class MenuService
{
    public function getMenuWithCategory(array $restoIds)
    {
        $categories = Menu::whereIn('resto_id' , $restoIds)
            ->get()
            ->groupBy('category.name');
        return $categories;
    }
}
