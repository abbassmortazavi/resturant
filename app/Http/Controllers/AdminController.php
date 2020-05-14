<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addTag(Request $request)
    {
        return Tag::create([
            'name'=>$request->name
        ]);
    }

    public function getAllTags()
    {
        return Tag::all();
    }
}
