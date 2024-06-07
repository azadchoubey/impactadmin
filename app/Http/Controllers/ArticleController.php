<?php

namespace App\Http\Controllers;

use App\Models\Clientkeyword;
use App\Models\Keywordlog;
use App\Models\Mongo\Article;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    public function viewarticle($id, $id2)
    {
        
        $articles = Article::where(['articleid' => $id, 'pubid' => $id2])
            ->get();
        $groupedResults = $articles->groupBy('articleid')
            ->map(function ($group) {
                $article = $group->first();

                $keywords = $group->flatMap(function ($item) {
                    return collect($item['keyword'])->mapWithKeys(function ($keyword) {
                        return [
                            'keyid' => $keyword['keyid'],
                            'keyword' => $keyword['keyword'],
                        ];
                    });
                })->unique()->all();

                $clients = $group->map(function ($item) {
                    return [
                        'clientid' => $item->clientid,
                        'clientname' => $item->clientname,
                    ];
                })->unique()->values()->all();

                return [
                    'article' => $article,
                    'keywords' => $keywords,
                    'clients' => $clients,
                ];
            });
         
        $groupedResults = $groupedResults->values()->first();
       
        return view('viewarticle', ['article' => $groupedResults]);
    }
    public function saveArticle(Request $request)
    {


        $request->validate([
            'articleid' => 'required',
            'clientids' => 'required',
            'keyid' => 'required'
        ], [
            'articleid.required' => 'Article ID is required',
            'clientids.required' => 'Client ID is required',
            'keyid.required' => 'Keyword ID is required'
        ]);
        $keyid = $request->input('keyid');
        $clientids = $request->input('clientids');
        $articleid = $request->input('articleid');
        $placeholders = implode(',', array_fill(0, count($clientids), '?'));
        try {
            DB::beginTransaction();
            $clientkeywords = Clientkeyword::where('KeywordID', $keyid)
                ->whereIn('ClientID', $clientids)
                ->get();

            if (!$clientkeywords) {
                return response()->json([
                    'error' => 'ClientKeyword not found for the given keyid.'
                ], 404);
            }
            $keywordlogs = [];
            foreach ($clientkeywords as $clientkeyword) {
                $keywordlogs[] = [
                    'keyid' => $keyid,
                    'clientid' => $clientkeyword->ClientID,
                    'articleid' => $articleid,
                    'keycategory' => $clientkeyword->Category,
                    'keytype' =>  $clientkeyword->Type,
                    'rejected' => 0,
                    'companys' => $clientkeyword->CompanyS,
                    'brands' => $clientkeyword->BrandS,
                ];
            }
            Keywordlog::insert($keywordlogs);
            $sql = "SELECT 'PRINT' as type, article.sq_allocatedDateTime as captureddatetime, clientprofile.clientid as clientid, clientprofile.name as clientname, pub_master.title as publication, article.articleid as articleid, GROUP_CONCAT(DISTINCT article_image.Page_Number SEPARATOR ',') as pno, article.Num_pages as numberofpages, article.title as article, ROUND(SUM(DISTINCT article_image.area), 0) as area, pub_master.pubid as pubid, picklist.name as city, article.md5id as md5id, article.Date_Time_Acqured as date_time_acquired, article.lastupdated as lastupdated, article.UserID as userid, article.pubdate as pubdate, GROUP_CONCAT(DISTINCT article_image.Image_name SEPARATOR ',') as imagename, GROUP_CONCAT( DISTINCT article_image.imagedirectory SEPARATOR ',') as imagedirectory, GROUP_CONCAT( DISTINCT article_image.htmldirectory SEPARATOR ',' ) as htmldirectory, GROUP_CONCAT(DISTINCT article_image.pageorder SEPARATOR ',') as pageorder, GROUP_CONCAT(keywordlog.keytype SEPARATOR ',') as keytpe, GROUP_CONCAT(keywordlog.keyid SEPARATOR ',') as keyid, GROUP_CONCAT(keyword_master.keyword SEPARATOR ';') as keyword, '' as full_text, GROUP_CONCAT( DISTINCT CONCAT(journalist.fname, ' ', journalist.lname) ) as journalist, article.sub_title as subtitle, '' as url, pub_master.circulation, pk.Name as category, pk1.Name as newscategory, pk2.Name as language, p3.name as Region, GROUP_CONCAT( IF( keywordlog.companys IS NULL OR keywordlog.companys = '', 'null', keywordlog.companys ) SEPARATOR ';' ) as companys, GROUP_CONCAT( IF( keywordlog.brands IS NULL OR keywordlog.brands = '', 'null', keywordlog.brands ) SEPARATOR ';' ) as brands, GROUP_CONCAT(clientkeyword.category SEPARATOR ';') as keycategory, GROUP_CONCAT( IFNULL(tbl_sentiment_v2.PosScore, 'null') SEPARATOR ',' ) as posscore, GROUP_CONCAT( IFNULL(tbl_sentiment_v2.NegScore, 'null') SEPARATOR ',' ) as negscore, GROUP_CONCAT( IFNULL(tbl_sentiment_v2.SentimentClass, 'null') SEPARATOR ',' ) as SentimentClass, GROUP_CONCAT( IFNULL(tbl_prominence_v3.Prominence, 'null') SEPARATOR ',' ) as Prominence, GROUP_CONCAT( CASE WHEN( tbl_prominence_v3.Prominence = 'headline mention' OR tbl_prominence_v3.Prominence = 'prominent' ) THEN 10 ELSE 0 END ) as pscore, p12.Name as frequcncy, IF( pub_master.primarypubid = 0, pub_master.title, pub1.title ) as primarypublication, pub_master.circulation as circulation, ROUND(article.ave) as ave, p6.Name as articletype, GROUP_CONCAT(DISTINCT keyword_master.Filter_String) as filter_string, p2.name as sector, article_image.pagename as pagename, article.num_pages as noofpages, article.isphoto as isphoto, article.IsColor as iscolor, pub_page_name.IsPre as ispremium, IFNULL(qualificationcommentandshowcase.showcase, 0) as showcase, pt.name as MediaType, snt.sentiment as sentiment, GROUP_CONCAT( DISTINCT CONCAT( tbl_prominence_v3.KeywordType, '--', tbl_prominence_v3.Prominence, '--', tbl_prominence_v3.companys ) ) as Pdata FROM keywordlog LEFT JOIN tbl_sentiment_v2 ON tbl_sentiment_v2.ArticleId = keywordlog.articleid AND tbl_sentiment_v2.ClientId = keywordlog.clientid AND tbl_sentiment_v2.companys = keywordlog.companys LEFT JOIN tbl_prominence_v3 ON tbl_prominence_v3.ArticleId = keywordlog.articleid AND tbl_prominence_v3.ClientId = keywordlog.clientid AND tbl_prominence_v3.companys = keywordlog.companys JOIN article_image ON article_image.articleid = keywordlog.articleid JOIN clientprofile ON clientprofile.clientid = keywordlog.clientid JOIN keyword_master ON keyword_master.keyid = keywordlog.keyid JOIN article ON article.articleid = keywordlog.articleid AND article.articleid = ? JOIN pub_master ON pub_master.pubid = article.pubid JOIN picklist ON picklist.id = pub_master.place JOIN picklist AS pk ON pk.ID = pub_master.Category JOIN picklist AS pk1 ON pk1.ID = pub_master.Type JOIN picklist AS pk2 ON pk2.ID = pub_master.Language JOIN picklist AS p3 ON p3.ID = pub_master.Region JOIN picklist AS pt ON pt.id = pub_master.Type LEFT JOIN clientkeyword ON keywordlog.keyid = clientkeyword.keywordid AND keywordlog.clientid = clientkeyword.ClientID LEFT JOIN pub_master pub1 ON pub1.pubid = pub_master.primarypubid LEFT JOIN article_journalist ON keywordlog.articleid = article_journalist.articleid LEFT JOIN journalist ON article_journalist.journalistid = journalist.jourid LEFT JOIN picklist AS p12 ON pub_master.periodicity = p12.ID LEFT JOIN picklist AS p6 ON p6.ID = article.TypePid LEFT JOIN picklist p2 ON article.sectorpid = p2.id LEFT JOIN pub_page_name ON article_image.pagename = pub_page_name.Name AND article.pubid = pub_page_name.pubid LEFT JOIN qualificationcommentandshowcase ON qualificationcommentandshowcase.article = keywordlog.articleid LEFT JOIN sentiment_print AS snt ON snt.articleid = article.id WHERE keywordlog.articleid = article.articleid AND keywordlog.rejected = 0 AND ( clientprofile.status <> 371 AND clientprofile.status <> 372 ) AND clientprofile.deleted <> 1 AND clientprofile.ClientID IN ($placeholders) GROUP BY keywordlog.articleid, keywordlog.clientid, article.sq_allocatedDateTime, clientprofile.name, pub_master.title, article.Num_pages, article.title, pub_master.pubid, picklist.name, article.md5id, article.Date_Time_Acqured, article.lastupdated, article.UserID, article.pubdate, article.sub_title, pub_master.circulation, pk.Name, pk1.Name, pk2.Name, p3.name, p12.Name, pub1.title, pub_master.circulation, ROUND(article.ave), p6.Name, p2.name, article_image.pagename, article.num_pages, article.isphoto, article.IsColor, pub_page_name.IsPre, IFNULL(qualificationcommentandshowcase.showcase, 0), pt.name, snt.sentiment ORDER BY keywordlog.clientid, keywordlog.articleid";
            $bindings = array_merge([$articleid], $clientids);
            $results = DB::select($sql, $bindings);
            $this->processArticles($results);
            DB::commit();
            Log::info(' Acticle Added Successfully in Keywordlog Articleid:{articleid}  by user: {user} ', ['articleid' => $articleid, 'user' => auth()->user()->UserID]);
            session()->flash('success', 'Acticle Added Successfully!');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error while saving Article in keywordlog: {error}', ['error' => $e->getMessage()]);
            session()->flash('error', 'An error occurred while adding the record.');
            return response()->json(['error' => 'Operation Failed!'], 500);
        }
    }
    private function processKeywords($result, $type = 'keyword')
    {
        $keywords = explode(";", $result[$type]);
        $keyIds = explode(",", $result['keyid']);
        $keyTypes = explode(",", $result['keytpe']);
        $companies = explode(";", $result['companys']);
        $brands = explode(";", $result['brands']);
        $keyCategories = explode(";", $result['keycategory']);
        $posScores = explode(",", $result['posscore']);
        $negScores = explode(",", $result['negscore']);
        $sentimentClasses = explode(",", $result['SentimentClass']);
        $prominences = explode(",", $result['Prominence']);
        $prominenceScores = explode(",", $result['pscore']);

        $keywordArray = [];

        for ($i = 0; $i < count($keywords); $i++) {
            $keywordArray[$i] = [
                'keyword' => trim($keywords[$i]),
                'keyid' => trim($keyIds[$i]),
                'keytpe' => trim($keyTypes[$i]),
                'companys' => trim($companies[$i]),
                'brandString' => mb_convert_encoding(trim($brands[$i]), 'UTF-8', 'UTF-8'),
                'keywordcategory' => trim($keyCategories[$i]),
                'positivescore' => trim($posScores[$i]),
                'negativescore' => trim($negScores[$i]),
                'Sentiment' => trim($sentimentClasses[$i]),
                'Prominence' => trim($prominences[$i]),
                'pscore' => trim($prominenceScores[$i]),
                'companyissue' => trim($companies[$i])
            ];
        }

        return array_values($keywordArray);
    }
    private function processArticles($results)
    {
        $results = json_decode(json_encode($results), true);
  
        $i = 0;
        while ($i < count($results)) {
            $createdAt = Carbon::createFromTimestampMs(round(microtime(true) * 1000))->setTimezone('UTC');
            $clientid = $results[$i]['clientid'];
           
            while ($i < count($results) && $clientid == $results[$i]['clientid']) {
                $articleid = $results[$i]['articleid'];
                $clientid = $results[$i]['clientid'];

                $keywordArray = $this->processKeywords($results[$i]);
                $imageArray = $this->processImages($results[$i]);
                $pageNoArray = $this->processPageNumbers($results[$i]);
                $pageOrderArray = $this->processPageOrders($results[$i]);
                $journalistArray = $this->processJournalists($results[$i]);
                $prominentArray = $this->processProminence($results[$i]);

                $area = $results[$i]['area'];
                $ave = $results[$i]['ave'];
                $circulation = $results[$i]['circulation'];
                $pubid = $results[$i]['pubid'];
                $showcase = $results[$i]['showcase'];
                $sentiment = $results[$i]['sentiment'];
                $noofpages = $results[$i]['noofpages'];
                $numberofpages = $results[$i]['numberofpages'];

                try {
                    Article::updateOrCreate(
                        [
                            'articleid' => $articleid,
                            'clientid' => $clientid
                        ],
                        [
                            'md5id' => $results[$i]['md5id'],
                            'headline' => mb_convert_encoding($results[$i]['article'], 'UTF-8', 'UTF-8'),
                            'subtitle' => mb_convert_encoding($results[$i]['subtitle'], 'UTF-8', 'UTF-8'),
                            'type' => $results[$i]['type'],
                            'captureddatetime' => $results[$i]['captureddatetime'],
                            'pubdate' => $results[$i]['pubdate'],
                            // 'imageUrl' => $imageUrls, // Adding image URLs to article data
                            'lastupdated' => $results[$i]['lastupdated'],
                            'date_time_acquired' => $results[$i]['date_time_acquired'],
                            'userid' => $results[$i]['userid'],
                            'numberofpages' => $numberofpages,
                            'pageorder' => $pageOrderArray,
                            'pagenumber' => $pageNoArray,
                            'area' => $area,
                            'imagename' => $imageArray,
                            'imagedirectory' => $results[$i]['imagedirectory'],
                            'htmldirectory' => $results[$i]['htmldirectory'],
                            'url' => $results[$i]['url'],
                            'publication' => mb_convert_encoding($results[$i]['publication'], 'UTF-8', 'UTF-8'),
                            'pubid' => $pubid,
                            'city' => $results[$i]['city'],
                            'journalist' => $journalistArray,
                            'circulation' => $circulation,
                            'category' => $results[$i]['category'],
                            'newscategory' => $results[$i]['newscategory'],
                            'language' => $results[$i]['language'],
                            'clientid' => $results[$i]['clientid'],
                            'clientname' => $results[$i]['clientname'],
                            'keyword' => $keywordArray,
                            'companysort' => getCompanyScore($keywordArray),
                            'competitionsort' => getCompetitionScore($keywordArray),
                            'industrysort' => getIndustryScore($keywordArray),
                            'frequcncy' => $results[$i]['frequcncy'],
                            'primarypublication' => mb_convert_encoding($results[$i]['primarypublication'], 'UTF-8', 'UTF-8'),
                            'ave' => $ave,
                            'articletype' => $results[$i]['articletype'],
                            'filter_string' => mb_convert_encoding($results[$i]['filter_string'], 'UTF-8', 'UTF-8'),
                            'sector' => $results[$i]['sector'],
                            'pagename' => $results[$i]['pagename'],
                            'noofpages' => $noofpages,
                            'isphoto' => $results[$i]['isphoto'],
                            'iscolor' => $results[$i]['iscolor'],
                            'ispremium' => $results[$i]['ispremium'],
                            'showcase' => $showcase,
                            'region' => $results[$i]['Region'],
                            'sentiment' => $sentiment,
                            'keyType' => array_values(array_unique($this->processKeywords($results[$i], 'keytpe'))),
                            'companyName' => array_values(array_unique($this->processKeywords($results[$i], 'companys'))),
                            'keywordIssue' => array_values(array_unique($this->processKeywords($results[$i], 'keyword'))),
                            'mlData' => $prominentArray,
                            'createdAt' => $createdAt,
                            'rejected' => 0,
                            'qualification' => []
                        ]
                    );
                } catch (\Exception $e) {
                    Log::error("Error updating articleid $articleid for clientid $clientid: " . $e->getMessage());
                }

                while ($i < count($results) && $clientid == $results[$i]['clientid'] && $articleid == $results[$i]['articleid']) {
                    $i++;
                }
            }
        }
    }
    private function processImages($result)
    {
        return explode(",", $result['imagename']);
    }

    private function processPageNumbers($result)
    {
        return explode(",", $result['pno']);
    }

    private function processPageOrders($result)
    {
        return explode(",", $result['pageorder']);
    }

    private function processJournalists($result)
    {
        return explode(",", $result['journalist']);
    }

    private function processProminence($result)
    {
        $prominentArray = [];
        $Pdata = explode(",", $result['Pdata']);
        for ($p = 0; $p < count($Pdata); $p++) {
            $PdataInner = explode("--", $Pdata[$p]);
            $prominentArray[$p]['keyType'] = $PdataInner[0];
            $prominentArray[$p]['prominent'] = $PdataInner[1];
            $prominentArray[$p]['company'] = $PdataInner[2];
        }
        return array_values($prominentArray);
    }

 
}
