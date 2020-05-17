<?php

namespace App\Http\Controllers;

use App\Category;
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
    public function deleteTag(Request $request)
    {
        return Tag::where('id' , $request->id)->delete();
    }
    public function getAllTags()
    {
        return Tag::orderBy('id' , 'desc')->get();
    }
    public function uploadImage(Request $request)
    {
        $this->validate($request , [
            'file'=>'required|mimes:jpeg,jpg,png'
        ]);
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
    public function insertCategory(Request $request)
    {
       // return $request->all();
        $this->validate($request , [
            'name'=>'required',
            'image'=>'required'
        ]);
        return Category::create([
            'name'=>$request->name,
            'image'=>$request->image
        ]);
    }
    public function getAllCategories()
    {
        return Category::orderBy('id' , 'desc')->get();
    }
    public function deleteCategory(Request $request)
    {
        return Category::where('id' , $request->id)->delete();
    }

    public function updateCategory(Request $request)
    {
        $this->validate($request , [
            'name'=>'required'
        ]);
        $category = Category::where('id' , $request->id)->first();
        if($request->image != $category->image)
        {
            $image = $request->image;
        }else{
            $image = $category->image;
        }
        
        $category->update([
            'name'=>$request->name,
            'image'=>$image
        ]);
       
    }
}
