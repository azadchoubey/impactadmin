<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MediaUniverseMaster extends Model
{
    use HasFactory;
    protected $table = 'media_universe_master';

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'clientid',
        'pubid',
        'id'
    ];
    public static function insertFromQuery($pubId)
    {
        $rawSql = "INSERT INTO media_universe_master (clientid, pubid)
select m1.clientid, pub_master.pubid from pub_master  join clientprofile m1  
join   media_universe m2  on m1.clientid=m2.clientid and m2.type='Language' 
and (m2.tagid=-1 or m2.tagid=pub_master.language )  
join   media_universe m3  on m1.clientid=m3.clientid 
and m3.type='Edition' and (m3.tagid=-1 or m3.tagid=pub_master.place )   
join   media_universe m4 on m1.clientid=m4.clientid 
and ( m4.type='NewsPaper'  and ((m4.tagid=-1 and m4.tag='A' )  
or (m4.tag='B'  and m4.tagid=pub_master.category ) or (m4.tag='C' and m4.tagid = pub_master.baseid)) ) 
or ( m4.type='Magazine'  and ((m4.tagid=-1 and m4.tag='A' ) 
 or (m4.tag='B'  and m4.tagid=pub_master.category ) 
 or (m4.tag='C' and m4.tagid =  pub_master.baseid))) 
 or ( m4.type='Supplement'  and ((m4.tagid=-1 and m4.tag='A' )
 or (m4.tag='B'  and m4.tagid=pub_master.category) or (m4.tag='C' and m4.tagid = pub_master.baseid))) 
 where pub_master.pubid = ? group by m1.clientid";

        try {
            DB::statement($rawSql, [$pubId]);
            Log::info('SQL Query executed successfully', ['pubid' => $pubId]);
        } catch (\Exception $e) {
            Log::error('SQL Query execution failed', ['error' => $e->getMessage(), 'pubid' => $pubId]);
        }
    }
}
