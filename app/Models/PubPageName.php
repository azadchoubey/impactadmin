<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PubPageName extends Model
{
    use HasFactory;
    protected $table = "pub_page_name";
    protected $primaryKey = 'PageNameID';
    public $timestamps = false;
    protected $fillable = [
        "PubId",
        "IsPre",
        "Name",
        "CreateDateTime",
        "EditDateTime"
    ];
}
