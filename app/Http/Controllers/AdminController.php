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
    public function uploadImage(Request $request)
    {
        $file = time().'.'.$request->file->extension();
        $path = '/uploads';
        $request->file->move(public_path($path) , $file);
        return $file;
    }
    public function deleteImage(Request $request)
    {
        $image = $request->image;
        $path = public_path('/uploads/'.$image);
        if(file_exists($path)){
            unlink($path);
        }
        return 'done';
    }
}
