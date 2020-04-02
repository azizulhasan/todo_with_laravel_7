<?php
// https://www.techiediaries.com/laravel-6-ajax-crud-tutorial-with-bootstrap-modal-and-pagination-example/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Http\TodoCreateRequest;
use App\HTTP\Requests\TodoCreateRequest;
use App\Todo;
use App\User;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class TodoController extends Controller
{
    public function index(){
        if (Auth::check()) {
            $todos = Todo::where('user_email', Auth::user()->email )->orderBy('id','desc')->get();
        return view('todos.index')->with(['todos'=>$todos]);
        }else{
            return view('auth.login');
        }
    }

    public function store(Request $request){
        if(Auth::check()){
            $data = ['title' => $request->title, 'user_email'=> Auth::user()->email];
            $id = Todo::insertGetId($data);
            $last_data = Todo::find($id);
            return response()->json($last_data);
        }else{
            return view('auth.login')->with("message","You need to first login");
        }
    }
   
    public function update(TodoCreateRequest $request){
        if(Auth::check()){
            $edit_data= Todo::where('id', $request->id['id'])->update(['title'=>$request->id['title']]);
                  $edit_data= Todo::find($request->id['id']);
                  return response()->json($edit_data);

        }else{
            return view('auth.login')->with("message","You need to first login");
        }
       
    }


    public function deleteall(Request $request)
    {
        Todo::whereIn("id",$request->id )->delete();
        return response()->json(['success'=>true]);
        
    }
    public function deletetodo(Request $request)
    {
        Todo::where("id", $request->id)->delete();
        return response()->json(['success'=>true]);
        
    }
}
