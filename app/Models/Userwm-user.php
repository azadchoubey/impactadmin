<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Userwm_user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "wm_users";
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'login',
        'password',
        'fullname',
        'role',
        'region',
        'agency',
        'active',
    ];

       
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    // relations

    public function user_role(){
        return $this->hasMany(Picklist::class,'ID','role');
    }
}
