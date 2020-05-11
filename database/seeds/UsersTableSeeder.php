<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Abbass',
            'email'=>'abbassmortazavi@gmail.com',
            'password'=>bcrypt('1111'),
        ]);
        
    }
}
