<?php

namespace App\Models\Mongo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'articles';
    public $timestamps = false;

    protected $fillable = [
        'articleid',
        'md5id',
        'headline',
        'subtitle',
        'type',
        'captureddatetime',
        'pubdate',
        'lastupdated',
        'date_time_acquired',
        'userid',
        'numberofpages',
        'pageorder',
        'pagenumber',
        'area',
        'imagename',
        'imagedirectory',
        'htmldirectory',
        'url',
        'publication',
        'pubid',
        'city',
        'journalist',
        'circulation',
        'category',
        'newscategory',
        'language',
        'clientid',
        'clientname',
        'keyword',
        'rejected',
        'sentiment',
        'keyType',
        'companyName',
        'keywordIssue',
        'mlData',
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp($value->toDateTime()->getTimestamp());
    }
}
