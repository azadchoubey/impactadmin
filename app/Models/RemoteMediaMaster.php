<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemoteMediaMaster extends Model
{
    use HasFactory;
    protected $table = 'remote_media_master';

    public $timestamps = false;

    protected $fillable = [
        'Profileid',
        'pubid',
       
    ];
}
