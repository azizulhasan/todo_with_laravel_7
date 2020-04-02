<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


use App\User;
class UserController extends Controller
{
    public function index(){


        // DB::insert("insert into users (name, email, password) values (?,?,?)", [
        //     'hasan','hasan@gmail.com', '123'
        // ]);

    //    DB::update("update users set name =? where id = 2 ", ['Azizul Hasan']);

    //    DB::delete("delete from users where id = 1");
    //    $users = DB::select("select * from users");
    //    return $users;

    // $user = new User();
    // $user->name = "Azizul";
    // $user->email = "azizulhasn@gmail.com";
    // $user->password = bcrypt("azizulhasn");
    // $user->save();
//    $user = User::all();
//    $user = User::where('id', 3)->delete();
//    User::where('id', 5)->update(['name'=>'salimullahwerwerw']);
//       $user = User::all();

        // $data =[
        //     'name'=>'monjur uddin',
        //     'email'=>'email@gmial.com',
        //     'password'=>'123',

        // ];

        // User::create($data);

        // $user = User::all();
        // return $user;
       if(Auth::check()){
        return view("auth.completeregister");
       }else{
        return view("auth.login");
       }
    }
    public function conmpleRegister(Request $request){
        if($request->hasFile('pic')){
        User::uploadAvatar($request->pic);
        return redirect('todos')->with("message", "Registration Completed");
        }
        return redirect()->back()->with("error", "Something went wrong.");
      
    }

    
}
