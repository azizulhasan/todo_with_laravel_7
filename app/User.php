<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use App\Message;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',"avatar",'user_type','remember_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setPasswordAttribute($password){
    //     $this->attributes['password'] =bcrypt($password);
    // }

    // public function getNameAttribute($name){
    //    return ucwords($name);
    // }


    public static function uploadAvatar($image){
        $filename = $image->getClientOriginalName();
        (new self())->deleteOldImage();
        $image->storeAs("img" ,$filename, 'public');
       auth()->user()->update(['avatar'=> $filename]);
      
    }

    protected function deleteOldImage(){
        if(auth()->user()->avatar){
            Storage::delete('/public/img/' . auth()->user()->avatar);
        }
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}
