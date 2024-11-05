<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClientWebUniverse extends Controller
{
    public function getCountries(Request $request)
    {
        $clientId = $request->clientid;

        $countries = DB::connection('mysql3')->table('wm_country_master')
            ->select([
                'wm_country_master.name as country',
                'wm_country_master.id as countryid',
                DB::raw("IF(wm_client_webuniverse_criteria_country.value IS NOT NULL, 'checked', '') as checked")
            ])
            ->leftJoin('wm_client_webuniverse_criteria_country', function ($join) use ($clientId) {
                $join->on('wm_client_webuniverse_criteria_country.value', '=', 'wm_country_master.id')
                    ->where('wm_client_webuniverse_criteria_country.clientid', '=', $clientId);
            })
            ->whereIn('wm_client_webuniverse_criteria_country.value', [87])
            ->groupBy('wm_country_master.id')
            ->orderBy('wm_country_master.name')
            ->distinct()
            ->get();
        return response()->json($countries, 200);
    }
    public function getCategories(Request $request)
    {

        $clientid = $request->clientid;
        $categories = DB::connection('mysql3')->table('wm_category_master')
            ->select([
                'wm_category_master.name as category',
                'wm_category_master.id as categoryid',
                DB::raw("IF(wm_client_webuniverse_criteria_category.value IS NOT NULL, 'checked', '') as checked")
            ])
            ->leftJoin('wm_client_webuniverse_criteria_category', function ($join) use ($clientid) {
                $join->on('wm_client_webuniverse_criteria_category.value', '=', 'wm_category_master.id')
                    ->where('wm_client_webuniverse_criteria_category.clientid', '=', $clientid);
            })
            ->groupBy('wm_category_master.id')
            ->orderBy('wm_category_master.name')
            ->distinct()
            ->get();
        return response()->json($categories, 200);
    }
    public function getIndustory(Request $request)
    {
        $clientId = $request->clientid;
        $industries = DB::connection('mysql3')->table('wm_industry_focus_master')
            ->select(
                'wm_industry_focus_master.name as industry',
                'wm_industry_focus_master.id as industryid',
                DB::raw("IF(wm_client_webuniverse_criteria_industry.value IS NOT NULL, 'checked', '') as checked")
            )
            ->leftJoin('wm_client_webuniverse_criteria_industry', function ($join) use ($clientId) {
                $join->on('wm_client_webuniverse_criteria_industry.value', '=', 'wm_industry_focus_master.id')
                    ->where('wm_client_webuniverse_criteria_industry.clientid', '=', $clientId);
            })
            ->groupBy('wm_industry_focus_master.id')
            ->orderBy('wm_industry_focus_master.name')
            ->get();
        return response()->json($industries, 200);
    }
    public function getFocus(Request $request)
    {
        $clientId = $request->clientid;

        $focuses = DB::connection('mysql3')->table('wm_focus_master')
            ->select(
                'wm_focus_master.name as focus',
                'wm_focus_master.id as focusid',
                DB::raw("IF(wm_client_webuniverse_criteria_focus.value IS NOT NULL, 'checked', '') as checked")
            )
            ->leftJoin('wm_client_webuniverse_criteria_focus', function ($join) use ($clientId) {
                $join->on('wm_client_webuniverse_criteria_focus.value', '=', 'wm_focus_master.id')
                    ->where('wm_client_webuniverse_criteria_focus.clientid', '=', $clientId);
            })
            ->groupBy('wm_focus_master.id')
            ->orderBy('wm_focus_master.name')
            ->distinct()
            ->get();
        return response()->json($focuses, 200);
    }
    public function getMedia(Request $request)
    {
        $clientId = $request->clientid;

        $types = DB::connection('mysql3')->table('wm_type_master')
            ->select(
                'wm_type_master.name as type',
                'wm_type_master.id as typeid',
                DB::raw("IF(wm_client_webuniverse_criteria_media_type.value IS NOT NULL, 'checked', '') as checked")
            )
            ->leftJoin('wm_client_webuniverse_criteria_media_type', function ($join) use ($clientId) {
                $join->on('wm_client_webuniverse_criteria_media_type.value', '=', 'wm_type_master.id')
                    ->where('wm_client_webuniverse_criteria_media_type.clientid', '=', $clientId);
            })
            ->groupBy('wm_type_master.id')
            ->orderBy('wm_type_master.name')
            ->distinct()
            ->get();
        return response()->json($types, 200);
    }
    public function getAudience(Request $request)
    {
        $clientId = $request->clientid;

        $audienceTypes = DB::connection('mysql3')->table('wm_audience_type_focus_master')
            ->select(
                'wm_audience_type_focus_master.name as audiencetype',
                'wm_audience_type_focus_master.id as audiencetypeid',
                DB::raw("IF(wm_client_webuniverse_criteria_audience_type_focus.value IS NOT NULL, 'checked', '') as checked")
            )
            ->leftJoin('wm_client_webuniverse_criteria_audience_type_focus', function ($join) use ($clientId) {
                $join->on('wm_client_webuniverse_criteria_audience_type_focus.value', '=', 'wm_audience_type_focus_master.id')
                    ->where('wm_client_webuniverse_criteria_audience_type_focus.clientid', '=', $clientId);
            })
            ->groupBy('wm_audience_type_focus_master.id')
            ->orderBy('wm_audience_type_focus_master.name')
            ->distinct()
            ->get();
        return response()->json($audienceTypes, 200);
    }
    public function getAudienceAge(Request $request)
    {
        $clientId = $request->clientid;

        $audienceAges = DB::connection('mysql3')->table('wm_audience_age_focus_master')
            ->select(
                'wm_audience_age_focus_master.name as audienceage',
                'wm_audience_age_focus_master.id as audienceageid',
                DB::raw("IF(wm_client_webuniverse_criteria_audience_age_focus.value IS NOT NULL, 'checked', '') as checked")
            )
            ->leftJoin('wm_client_webuniverse_criteria_audience_age_focus', function ($join) use ($clientId) {
                $join->on('wm_client_webuniverse_criteria_audience_age_focus.value', '=', 'wm_audience_age_focus_master.id')
                    ->where('wm_client_webuniverse_criteria_audience_age_focus.clientid', '=', $clientId);
            })
            ->groupBy('wm_audience_age_focus_master.id')
            ->orderBy('wm_audience_age_focus_master.name')
            ->distinct()
            ->get();
        return response()->json($audienceAges, 200);
    }
    public function getRegional(Request $request)
    {
        $clientId = $request->clientid;

        $regions = DB::connection('mysql3')->table('wm_region_master')
            ->select(
                'wm_region_master.name as regional',
                'wm_region_master.id as regionalid',
                DB::raw("IF(wm_client_webuniverse_criteria_regional_focus.value IS NOT NULL, 'checked', '') as checked")
            )
            ->leftJoin('wm_client_webuniverse_criteria_regional_focus', function ($join) use ($clientId) {
                $join->on('wm_client_webuniverse_criteria_regional_focus.value', '=', 'wm_region_master.id')
                    ->where('wm_client_webuniverse_criteria_regional_focus.clientid', '=', $clientId);
            })
            ->groupBy('wm_region_master.id')
            ->orderBy('wm_region_master.name')
            ->distinct()
            ->get();
        return response()->json($regions, 200);
    }
    public function saverssRegenerate(Request $request)
    {
        try {


            $clientId = $request->clientid;
            $webrank = $request->input('txtwebrank');
            $newsrank = $request->input('txtnewsrank');
            $reach = $request->input('txtreach');

            $webrankQuery = $webrank ? ['webrank', '>=', $webrank] : null;
            $newsrankQuery = $newsrank ? ['newsrank', '>=', $newsrank] : null;
            $reachQuery = $reach ? ['reach', '>=', $reach] : null;

            $selectedCountries = explode("|", $request->input('countries', ''));
            $selectedCategories = explode("|", $request->input('categories', ''));
            $selectedIndustries = explode("|", $request->input('industries', ''));
            $selectedFocuses = explode("|", $request->input('focuses', ''));
            $selectedMediaTypes = explode("|", $request->input('mediatypes', ''));
            $selectedAudienceTypes = explode("|", $request->input('audiencetypes', ''));
            $countryQuery = $selectedCountries ? ['countryoforigin', $selectedCountries] : null;
            $categoryQuery = $selectedCategories ? ['category', $selectedCategories] : null;
            $industryQuery = $selectedIndustries ? ['industryfocus', $selectedIndustries] : null;
            $focusQuery = $selectedFocuses ? ['focus', $selectedFocuses] : null;
            $mediaTypeQuery = $selectedMediaTypes ? ['type', $selectedMediaTypes] : null;
            $audienceTypeQuery = $selectedAudienceTypes ? ['audiencetypefocusid', $selectedAudienceTypes] : null;
            // Start building the main query
            $query = RssFeed::select('wm_rss_feed.id as rssid')
                ->join('wm_web_universe as wu', 'wm_rss_feed.wm_web_universe_id', '=', 'wu.id')
                ->where('wu.deleted', 0)
                ->where('wm_rss_feed.deleted', 0);

            // Apply conditional filters
            if ($webrankQuery) $query->where($webrankQuery);
            if ($newsrankQuery) $query->where($newsrankQuery);
            if ($reachQuery) $query->where($reachQuery);

            if ($selectedCountries) $query->whereIn('countryoforigin', $selectedCountries);
            if ($selectedCategories) $query->whereIn('category', $selectedCategories);
            if ($selectedIndustries) $query->whereIn('industryfocus', $selectedIndustries);
            if ($selectedFocuses) $query->whereIn('focus', $selectedFocuses);
            if ($selectedMediaTypes) $query->whereIn('type', $selectedMediaTypes);
            if ($selectedAudienceTypes) $query->whereIn('audiencetypefocusid', $selectedAudienceTypes);

            $rssFeeds = $query->get();


            DB::table('wm_url_link')->truncate();

            foreach ($rssFeeds as $feed) {
                DB::table('wm_url_link')->insert(['rssid' => $feed->rssid]);
            }
            $this->storeCriteria(
                $clientId,
                $selectedAudienceTypes,
                $selectedCategories,
                $selectedCountries,
                $selectedMediaTypes,
            );
            Log::info('RSS Regenerate success');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false], 500);
        }
    }

    protected function buildCriteriaQuery($column, $values)
    {
        if (is_null($values) || !is_array($values) || empty($values)) {
            return '';
        }
        if ($values || count($values) > 2) {
            $query = "";
        } else {
            $query = "($column IN (" . implode(',', array_map('intval', $values)) . "))";
        }
        return $query;
    }

    // Helper function to add where conditions to the query
    protected function addWhereConditions($query, $conditions)
    {
        foreach ($conditions as $condition) {
            if (!empty($condition)) {
                $query->whereRaw($condition);
            }
        }
    }
    protected function storeCriteria(
        $client,
        $audienceTypeFocusCriteria,
        $categoryCriteria,
        $countryCriteria,
        $mediaTypeCriteria,
     
    ) {
        DB::statement("CALL sp_delete_client_web_universe_criteria(?)", [$client]);

        if (request()->input('default')) {
            $sessionId = \Session::getId();

            $this->insertCriteria($sessionId, $audienceTypeFocusCriteria, $client, 'audience_type_focus');
            $this->insertCriteria($sessionId, $categoryCriteria, $client, 'category');
            $this->insertCriteria($sessionId, $countryCriteria, $client, 'country');
            $this->insertCriteria($sessionId, $mediaTypeCriteria, $client, 'media_type');
        }
    }

    protected function insertCriteria($sessionId, $criteriaValue, $client, $type)
    {
        if (trim($criteriaValue) == "") {
            $criteriaValue = "(-1)";
        }

        DB::statement("CALL sp_insert_client_web_universe_criteria(?, ?, ?, ?)", [$sessionId, $criteriaValue, $client, $type]);
    }
}
