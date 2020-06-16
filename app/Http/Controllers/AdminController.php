<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
         //return Auth::check();
        if(!Auth::check() && $request->path() != 'login')
        {
            return redirect('/login');
        }
       
        if($request->path() == "login" && Auth::user()){
            return redirect('/home');
        }
        return view('welcome');
        //return $request->path();
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message'=>"Logout SuccessFull"
        ]);
        //return redirect('/login');
    }

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


    //User
    public function addUser(Request $request)
    {
        $this->validate($request , [
            'fullName'=>'required',
            'email'=>'required',
            'password'=>'required|min:4'
        ]);
        $password = bcrypt($request->password);
        return User::create([
            'fullName'=>$request->fullName,
            'email'=>$request->email,
            'password'=>$password,
            'user_type'=>$request->user_type,
        ]);
    }
    public function updateUser(Request $request)
    {
        $this->validate($request , [
            'fullName'=>'required',
            'email'=>'required',
        ]);
        $user = User::where('id' , $request->id)->first();
        if ($user->password != $request->password){
            $password = bcrypt($request->password);
        }else{
            $password =$user->password;
        }
        $user->update([
            'fullName'=>$request->fullName,
            'email'=>$request->email,
            'password'=>$password,
            'user_type'=>$request->user_type,
        ]);
       
    }
    public function getAllUsers()
    {
        return User::orderBy('id' , 'desc')->get();
    }
    public function deleteUser(Request $request)
    {
        return User::where('id' , $request->id)->delete();
    }

    public function loginUser(Request $request)
    {
        $this->validate($request , [
            'email'=>'bail|required|email',
            'password'=>'bail|required|min:4'
        ]);

        if(Auth::attempt(['email'=>$request->email , 'password'=>$request->password]))
        {
            $user = Auth::user();
            if($user->user_type == "user"){
                return response()->json([
                    'message'=>"User is Not Admin!"
                ], 401);
            }
            return response()->json([
                'message'=>"Login SuccessFull",
                'user' => $user
            ]);
        }else{
            return response()->json([
                'message'=>"Login Fail"
            ], 401);
        }
    }
}
