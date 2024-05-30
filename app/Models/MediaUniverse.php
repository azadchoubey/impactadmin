<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaUniverse extends Model
{
    use HasFactory;
    protected $table = 'media_universe';

    public $timestamps = false;

    protected $fillable = [
        'clientid',
        'type',
        'id',
        'tag',
        'tagid'
    ];
}
