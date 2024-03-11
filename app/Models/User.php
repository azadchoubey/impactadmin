<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "userinfo";
    protected $primaryKey = 'Id';
    public $timestamps = false;
    protected $fillable = [
        'Id',
        'UserID',
        'UserName',
        'Profile',
        'RemoteProfileID',
        'AllowRemote',
        'LastUpdate',
        'Password',
        'Md5Pass',
        'tmp',
        'ProfileId',
        'EmailID',
        'citycode',
    ];

       
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Md5Pass'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    // relations

    // public function user_role(){
    //     return $this->hasMany(Picklist::class,'ID','role');
    // }
    public function Remoteuser (){
        return $this->hasMany(Picklist::class,'ID','RemoteProfileID');
    }
}
