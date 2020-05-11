<?php

use App\Category;
use App\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dumyCategory = collect([
            'Soups' , 'Chicken Main Course' , 'Non- veg Rice' , 'Non-veg Noodles'
        ]);


        $dumyCategory->each(function ($value){
            factory(Category::class)->create(['name'=>$value]);
        });


        /*$categories = factory(Category::class , 5)->create();
        $categories->each(function($category){
            factory(Menu::class , 4)->create([
                'category_id'=>$category->id
            ]);
        });*/
        $this->addSoups();
        $this->addMainCourse();
        $this->addNonVegRice();
        $this->addNonVegNodles();

    }
    private function addSoups()
    {
        factory(Menu::class)->create([
            'name'=> 'Chicken Soup',
            'price'=> 170,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 1
        ]);

        factory(Menu::class)->create([
            'name'=> 'Chicken Beijing Soup',
            'price'=> 160,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 1,
        ]);

        factory(Menu::class)->create([
            'name'=> 'Chicken Wanten Soup',
            'price'=> 160,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 1,
        ]);
    }
    public function addMainCourse()
    {
        factory(Menu::class)->create([
            'name'=> 'Grilled Chicken Panini',
            'price'=> 290,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 2,
        ]);

        factory(Menu::class)->create([
            'name'=> 'Sape Chicken',
            'price'=> 310,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 2,
        ]);

        factory(Menu::class)->create([
            'name'=> 'Chicken Black Bean',
            'price'=> 270,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 2,
        ]);
    }
    public function addNonVegRice()
    {
        factory(Menu::class)->create([
            'name'=> 'Chicken Fried Rice',
            'price'=> 220,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 3,
        ]);

        factory(Menu::class)->create([
            'name'=> 'Mainance Chicken Rice',
            'price'=> 250,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 3,
        ]);

        factory(Menu::class)->create([
            'name'=> 'Chicken Chettined',
            'price'=> 250,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 3,
        ]);
    }
    public function addNonVegNodles()
    {
        factory(Menu::class)->create([
            'name'=> 'Cart noodlea',
            'price'=> 220,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 4,
        ]);
        factory(Menu::class)->create([
            'name'=> 'Chow main noodles',
            'price'=> 280,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 4,
        ]);

        factory(Menu::class)->create([
            'name'=> 'Chanqing noodles',
            'price'=> 260,
            'description'=> 'this is very good food and very nice food...',
            'category_id'=> 4,
        ]);
    }
}
