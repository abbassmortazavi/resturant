<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Services\MenuService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(MenuService $menuService)
    {
        //18:38 -- 4
        $resto = [1];
        $categories = $menuService->getMenuWithCategory($resto);
        return view('home' , compact('categories'));
    }
}
