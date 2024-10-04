<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WmWebUniverse extends Model
{
    use HasFactory;

    protected $table = "wm_web_universe";

    protected $fillable = [
        'url',
        'name',
        'webrank',
        'newsrank',
        'reach',
        'countryoforigin',
        'address',
        'category',
        'type',
        'advertisingrates'
    ];
}
