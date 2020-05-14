<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function addTag(Request $request)
    {
        $this->validate($request , [
            'name'=>'required'
        ]);
        return Tag::create([
            'name'=>$request->name
        ]);
    }
    public function updateTag(Request $request)
    {
        $this->validate($request , [
            'name'=>'required'
        ]);
        return Tag::where('id' , $request->id)->update([
            'name'=>$request->name
        ]);
       
    }
    public function getAllTags()
    {
        return Tag::orderBy('id' , 'desc')->get();
    }
}
