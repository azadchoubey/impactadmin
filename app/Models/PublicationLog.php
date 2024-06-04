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
        'key_lock',
    ];
    public static function getLatestLogByPubId($pubid, $clientIp, $userid)
    {
        $latestLog =  self::where('pubid', $pubid)
            ->orderBy('Sno', 'DESC')
            ->first(['key_lock', 'date_time', 'userid']);
            if ($latestLog) {
                return $latestLog;
            }
            self::create([
                'pubid' => $pubid,
                'date_time' => now(),
                'pcname' => $clientIp,
                'userid' => $userid,
                'key_lock' => 1,
            ]);
    
            return false;
    }
}
