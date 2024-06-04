<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RemoteMediaMaster extends Model
{
    use HasFactory;
    protected $table = 'remote_media_master';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'Profileid',
        'pubid',
       
    ];
        public static function insertFromQuery($pubId)
        {
            $rawSql = "insert into remote_media_master (profileid,pubid) 
            select distinct m1.profileid, pub_master.pubid from pub_master  join remote_media m1  
        join   remote_media m2  on m1.profileid=m2.profileid and m2.type='Language' and (m2.tagid=-1 or m2.tagid=pub_master.language )  
        join   remote_media m3  on m1.profileid=m3.profileid and m3.type='Edition' and (m3.tagid=-1 or m3.tagid=pub_master.place )   
        join   remote_media m4 on m1.profileid=m4.profileid and ( m4.type='NewsPaper'  and ((m4.tagid=-1 and m4.tag='A' )  or (m4.tag='B'  and m4.tagid=pub_master.category ) or (m4.tag='C' and m4.tagid = pub_master.baseid)) ) or ( m4.type='Magazine'  and ((m4.tagid=-1 and m4.tag='A' )  or (m4.tag='B'  and m4.tagid=pub_master.category ) or (m4.tag='C' and m4.tagid =  pub_master.baseid))) or ( m4.type='Supplement'  and ((m4.tagid=-1 and m4.tag='A' )  or (m4.tag='B'  and m4.tagid=pub_master.category) or (m4.tag='C' and m4.tagid = pub_master.baseid))) 
            where pub_master.pubid = ?";
            try {
                DB::statement($rawSql, [$pubId]);
                Log::info('SQL Query executed successfully', ['pubid' => $pubId]);
            } catch (\Exception $e) {
                Log::error('SQL Query execution failed', ['error' => $e->getMessage(), 'pubid' => $pubId]);
            }
        }
}
