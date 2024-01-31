<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keywordmaster extends Model
{
    use HasFactory;
    protected $table = "keyword_master";
    protected $primaryKey = 'keyID';
}
