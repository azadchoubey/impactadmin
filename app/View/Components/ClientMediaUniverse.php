<?php

namespace App\View\Components;

use App\Models\MediaUniverse;
use App\Models\MediaUniverseMaster;
use App\Models\Picklist;
use App\Models\Pubmaster;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ClientMediaUniverse extends Component
{
    public $priority ,$restrictedmu,$newspapers, $selectpubnews, $Magazines, $clientmagazines, $clientnewspaper, $comments, $clientid, $Language, $clientlang, $Edition, $clientedition, $clientnewspapercat, $Newspapercat, $Magazinecat, $clientmagazinecat;
    /**
     * Create a new component instance.
     */
    public function __construct($clientid,$priority,$restrictedmu)
    {
        $this->clientid = $clientid;
        $this->restrictedmu = $restrictedmu;
        $this->priority = $priority;

        $subquery = MediaUniverse::on('mysql2')->select('tagId')
            ->where('clientId', $clientid)
            ->where('type', 'Language');

        $this->Language = Picklist::on('mysql2')->select('picklist.name as Name', 'picklist.id as ID')
            ->join('pub_master', 'pub_master.language', '=', 'picklist.id')
            ->whereNotIn('picklist.id', $subquery)
            ->whereNotIn('picklist.id',[0])
            ->distinct()
            ->orderBy('picklist.name')
            ->get();
        $this->clientlang = Picklist::on('mysql2')->select('picklist.name as Name', 'picklist.id as ID')
            ->join('media_universe as mucp', 'mucp.tagId', '=', 'picklist.id')
            ->where('mucp.type', 'Language')
            ->where('mucp.clientId', $clientid)
            ->distinct()
            ->orderBy('picklist.name')
            ->get();
        $tagId = Mediauniverse::on('mysql2')->where('clientId', $clientid)
            ->where('tagId', -1)
            ->where('type', 'Edition')
            ->pluck('tagId')
            ->first();
        $additionalIds = [
            -6 => '6 Cities',
            -8 => '6+2 Cities'
        ];
    
        if ($tagId !== null) {
            $selectedVal = $additionalIds[$tagId];
            unset($additionalIds[$tagId]);
        }
    
        $this->Edition = collect();
        foreach ($additionalIds as $key => $val) {
            $this->Edition->push((object) ['Name' => $val, 'ID' => $key]);
        }
            $subquery = Mediauniverse::on('mysql2')->select('tagId')
            ->where('clientId', $clientid)
            ->where('type', 'Edition');

            $editionResults = Picklist::on('mysql2')->select('picklist.name as Name', 'picklist.id as ID')
            ->join('pub_master', 'pub_master.place', '=', 'picklist.id')
            ->whereNotIn('pub_master.place', $subquery)
            ->whereNotIn('picklist.id',[0])
            ->distinct()
            ->orderBy('picklist.name')
            ->get();
            $this->Edition = $this->Edition
            ->merge($editionResults->map(function($result) {
                return (object) ['Name' => $result->Name, 'ID' => $result->ID];
            }))
            ->sort(function($a, $b) {
                if ($a->Name === '') {
                    return -1;
                }
                if ($b->Name === '') {
                    return 1;
                }
                return strcasecmp($a->Name, $b->Name);
            });
       
        $this->clientedition = Picklist::on('mysql2')->select(DB::raw('distinct picklist.name as Name'), 'picklist.id as ID')
            ->join('media_universe as mucp', 'mucp.tagId', '=', 'picklist.id')
            ->where('mucp.type', 'Edition')
            ->where('mucp.clientId', $clientid)
            ->orderBy('picklist.name')
            ->get();

        $subquery = Mediauniverse::on('mysql2')->select('tagId')
            ->where('clientId', $clientid)
            ->where('type', 'Newspaper')
            ->where('tag', 'B');

        $this->Newspapercat = Pubmaster::on('mysql2')->select(DB::raw('distinct picklist.Name as Category'), 'picklist.ID as catid')
            ->leftJoin('picklist', 'pub_master.Category', '=', 'picklist.ID')
            ->where('pub_master.primaryPubId', 0)
            ->where('pub_master.Type', 230)
            ->where('picklist.Name', '!=', '')
            ->whereNotIn('pub_master.Category', $subquery)
            ->orderBy('picklist.Name')
            ->get();

        $this->clientnewspapercat = Mediauniverse::on('mysql2')->select(DB::raw('distinct picklist.Name as Category'), 'picklist.ID as catid')
            ->leftJoin('picklist', 'media_universe.tagId', '=', 'picklist.ID')
            ->leftJoin('pub_master', 'picklist.ID', '=', 'pub_master.Category')
            ->where('pub_master.primaryPubId', 0)
            ->where('pub_master.Type', 230)
            ->where('media_universe.type', 'Newspaper')
            ->where('media_universe.tag', 'B')
            ->where('media_universe.clientId', $clientid)
            ->whereNotNull('picklist.ID')
            ->orderBy('Category')
            ->get();

        $subquery = Mediauniverse::on('mysql2')->select('tagId')
            ->where('clientId', $clientid)
            ->where('type', 'Magazine')
            ->where('tag', 'B')
            ->getQuery();

        $this->Magazinecat = Pubmaster::on('mysql2')->select(DB::raw('distinct picklist.Name as Category'), 'picklist.ID as catid')
            ->leftJoin('picklist', 'pub_master.Category', '=', 'picklist.ID')
            ->where('pub_master.primaryPubId', 0)
            ->where('pub_master.Type', 229)
            ->where('picklist.Name', '!=', '')
            ->whereNotIn('pub_master.Category', $subquery)
            ->orderBy('picklist.Name')
            ->get();
        $this->clientmagazinecat = MediaUniverse::on('mysql2')->selectRaw('DISTINCT picklist.Name as Category, picklist.ID as catid')
            ->leftJoin('picklist', 'media_universe.tagid', '=', 'picklist.ID')
            ->leftJoin('pub_master', 'picklist.ID', '=', 'pub_master.Category')
            ->where('pub_master.primaryPubId', 0)
            ->where('pub_master.Type', 229)
            ->where('media_universe.type', 'Magazine')
            ->where('media_universe.tag', 'B')
            ->where('media_universe.clientId', $clientid)
            ->whereNotNull('picklist.ID')
            ->orderBy('Category')
            ->get();
        $this->comments =  DB::connection('mysql2')->table('wm_users')
            ->join('MUComment', 'wm_users.login', '=', 'MUComment.user')
            ->where('MUComment.clientid', $clientid)
            ->where('MUComment.isdeleted', 'No')
            ->orderBy('MUComment.id', 'desc')
            ->select('wm_users.fullname', 'MUComment.comment', 'MUComment.createddatetime', 'MUComment.id')
            ->get();
            
        $this->newspapers = Pubmaster::on('mysql2')->select('pub_master.Title as title', 'pub_master.PubId as pubid', 'picklist.Name as ediPlace')
            ->join('picklist', 'pub_master.Place', '=', 'picklist.ID')
            ->where('pub_master.Type', 230)
            ->where('pub_master.PrimaryPubID', 0)
            ->where('pub_master.deleted', 0)
            ->whereNotIn('pub_master.pubid', function ($query) use ($clientid) {
                $query->select('mum.pubid')
                    ->from('media_universe_master as mum')
                    ->join('pub_master as pm', 'mum.pubid', '=', 'pm.PubId')
                    ->where('mum.clientid', $clientid)
                    ->where('pm.Type', 230)
                    ->where('pm.PrimaryPubID', 0)
                    ->where('pm.deleted', 0);
            })
            ->where('pub_master.deleted', 0)
            ->orderBy('pub_master.Title')
            ->get();
        $this->clientnewspaper = MediaUniverseMaster::on('mysql2')->select('media_universe_master.pubid as pubid', 'pm.Title as title', 'pl.Name as ediPlace')
            ->join('pub_master as pm', 'media_universe_master.pubid', '=', 'pm.PubId')
            ->join('picklist as pl', 'pm.Place', '=', 'pl.ID')
            ->where('media_universe_master.clientid', $clientid)
            ->where('pm.Type', 230)
            ->where('pm.PrimaryPubID', 0)
            ->where('pm.deleted', 0)
            ->orderBy('pm.Title')
            ->get();
        $this->Magazines = PubMaster::on('mysql2')->select('pub_master.Title as title', 'pub_master.PubId as pubid', 'picklist.Name as ediPlace')
            ->join('picklist', 'pub_master.Place', '=', 'picklist.ID')
            ->where('pub_master.Type', 229)
            ->where('pub_master.PrimaryPubID', 0)
            ->where('pub_master.deleted', 0)
            ->whereNotIn('pub_master.pubid', function ($query) use ($clientid) {
                $query->select('pubid')
                    ->from(DB::raw("(SELECT mum.pubid as pubid
                              FROM media_universe_master as mum
                              join pub_master as pm on mum.pubid = pm.PubId
                              where clientid = '{$clientid}' AND pm.Type = 229 AND pm.PrimaryPubID = 0 AND pm.deleted = 0) as t"));
            })
            ->where('deleted', 0)
            ->get();
        $this->clientmagazines = MediaUniverseMaster::on('mysql2')->select('media_universe_master.pubid as pubid', 'pm.Title as title', 'pl.Name as ediPlace')
            ->join('pub_master as pm', 'media_universe_master.pubid', '=', 'pm.PubId')
            ->join('picklist as pl', 'pm.Place', '=', 'pl.ID')
            ->where('media_universe_master.clientid', $clientid)
            ->where('pm.Type', 229)
            ->where('pm.PrimaryPubID', 0)
            ->where('pm.deleted', 0)
            ->orderBy('pm.Title')
            ->get();
        $this->selectpubnews = Pubmaster::on('mysql2')->where('IsMain', 1)->pluck('PubId')->toArray();
    }


    public function render(): View|Closure|string
    {
        return view('components.client-media-universe');
    }
}
