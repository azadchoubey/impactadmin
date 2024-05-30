<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationLog extends Model
{
    use HasFactory;

    protected $table = 'publication_log';

    public $timestamps = false;

    protected $primaryKey = 'Sno';


    protected $fillable = [
        'Sno',
        'pubid',
        'date_time',
        'pcname',
        'userid',
        'key_lock',];
}
