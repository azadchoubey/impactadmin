<?php

namespace App\View\Components;

use App\Models\MediaUniverse;
use App\Models\Picklist;
use App\Models\Pubmaster;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ClientMediaUniverse extends Component
{
    public $comments,$clientid,$Language, $clientlang, $Edition, $clientedition, $clientnewspapercat, $Newspapercat, $Magazinecat, $clientmagazinecat;
    /**
     * Create a new component instance.
     */
    public function __construct($clientid)
    {
        $this->clientid = $clientid;
       
        $subquery = MediaUniverse::select('tagId')
            ->where('clientId', $clientid)
            ->where('type', 'Language');

        $this->Language = Picklist::select('picklist.name as Name', 'picklist.id as ID')
            ->join('pub_master', 'pub_master.language', '=', 'picklist.id')
            ->whereNotIn('picklist.id', $subquery)
            ->distinct()
            ->orderBy('picklist.name')
            ->get();
            $this->clientlang = Picklist::select('picklist.name as Name', 'picklist.id as ID')
            ->join('media_universe as mucp', 'mucp.tagId', '=', 'picklist.id')
            ->where('mucp.type', 'Language')
            ->where('mucp.clientId', $clientid)
            ->distinct()
            ->orderBy('picklist.name')
            ->get();
        $subquery = Mediauniverse::select('tagId')
            ->where('clientId', $clientid)
            ->where('type', 'Edition');

        $this->Edition = Picklist::select('picklist.name as Name', 'picklist.id as ID')
            ->join('pub_master', 'pub_master.place', '=', 'picklist.id')
            ->whereNotIn('pub_master.place', $subquery)
            ->distinct()
            ->orderBy('picklist.name')
            ->get();

            $this->clientedition = Picklist::select(DB::raw('distinct picklist.name as Name'), 'picklist.id as ID')
            ->join('media_universe as mucp', 'mucp.tagId', '=', 'picklist.id')
            ->where('mucp.type', 'Edition')
            ->where('mucp.clientId', $clientid)
            ->orderBy('picklist.name')
            ->get();
            $subquery = Mediauniverse::select('tagId')
            ->where('clientId', $clientid)
            ->where('type', 'Newspaper')
            ->where('tag', 'B');

        $this->Newspapercat = Pubmaster::select(DB::raw('distinct picklist.Name as Category'), 'picklist.ID as catid')
            ->leftJoin('picklist', 'pub_master.Category', '=', 'picklist.ID')
            ->where('pub_master.primaryPubId', 0)
            ->where('pub_master.Type', 230)
            ->where('picklist.Name', '!=', '')
            ->whereNotIn('pub_master.Category', $subquery)
            ->orderBy('picklist.Name')
            ->get();

            $this->clientnewspapercat = Mediauniverse::select(DB::raw('distinct picklist.Name as Category'), 'picklist.ID as catid')
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

            $subquery = Mediauniverse::select('tagId')
            ->where('clientId', $clientid)
            ->where('type', 'Magazine')
            ->where('tag', 'B')
            ->getQuery();

        $this->Magazinecat = Pubmaster::select(DB::raw('distinct picklist.Name as Category'), 'picklist.ID as catid')
            ->leftJoin('picklist', 'pub_master.Category', '=', 'picklist.ID')
            ->where('pub_master.primaryPubId', 0)
            ->where('pub_master.Type', 229)
            ->where('picklist.Name', '!=', '')
            ->whereNotIn('pub_master.Category', $subquery)
            ->orderBy('picklist.Name')
            ->get();
            $this->clientmagazinecat = MediaUniverse::selectRaw('DISTINCT picklist.Name as Category, picklist.ID as catid')
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
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.client-media-universe');
    }
}
