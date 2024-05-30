<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pubbase extends Model
{
    use HasFactory;
    protected $table = 'pub_base';

    public $timestamps = false;

    protected $primaryKey = 'baseid';

    protected $fillable = [
        'baseid',
        'name',
        'webid'
    ];
}
