<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaUniverseMaster extends Model
{
    use HasFactory;
    protected $table = 'media_universe_master';

    public $timestamps = false;

    protected $fillable = [
        'clientid',
        'pubid',
        'id'
    ];
}
