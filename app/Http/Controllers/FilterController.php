<?php

namespace App\Http\Controllers;

use App\Models\MediaUniverse;
use App\Models\MediaUniverseMaster;
use App\Models\Pubmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FilterController extends Controller
{
    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $clientId = $request->input('clientid');
            $mainPaper = $request->input('mainPaper') === 'true';

            // Main Paper Condition
            $mainPaperCondition = $mainPaper ? ['IsMain', '=', 1] : [];

            // Handle Editions
            $placeConditions = $this->handleEditions($request->input('edition'));

            // Handle Newspaper Categories
            $categoryConditions = $this->handleCategoryCondition($request->input('newspapercat'));
          
            // Handle Magazine Categories
            $magCategoryConditions = $this->handleCategoryCondition($request->input('magzinecat'));

            // Handle Languages
            $languageConditions = $this->handleLanguages($request->input('language'));

            // Filtering Newspaper
            $news = PubMaster::on('mysql2')->where('PrimaryPubId', 0)
                ->where('type', 230)
                ->where($mainPaperCondition)
                ->where($placeConditions)
                ->where(function ($query) use ($categoryConditions) {
                    if ($categoryConditions) {
                        if ($categoryConditions[1] === 'IN') {
                            $query->whereIn($categoryConditions[0], $categoryConditions[2]);
                        } else {
                            $query->where($categoryConditions[0], $categoryConditions[1], $categoryConditions[2]);
                        }
                    }
                })
                ->where(function ($query) use ($languageConditions) {
                    if ($languageConditions) {
                        if ($languageConditions[1] === 'IN') {
                            $query->whereIn($languageConditions[0], $languageConditions[2]);
                        } else {
                            $query->where($languageConditions[0], $languageConditions[1], $languageConditions[2]);
                        }
                    }
                })
                ->where('deleted', 0)
                ->with('edition')
                ->orderBy('Title')
                ->get();
            $newsOptions = $this->generateSelectOptions($news);
                    
            // Rest of the Newspapers
            $newsAll = PubMaster::on('mysql2')->where('PrimaryPubId', 0)
                ->where('type', 230)
                ->whereNotIn('PubId', $news->pluck('PubId'))
                ->where('deleted', 0)
                ->with('edition')
                ->orderBy('Title')
                ->get();

            $newsAllOptions = $this->generateSelectOptions($newsAll);
            // Filtering Magazines

            $magazines = PubMaster::on('mysql2')->where('PrimaryPubId', 0)
                ->where('type', 229)
                ->where($mainPaperCondition)
                ->where($placeConditions)
                ->where(function ($query) use ($magCategoryConditions) {
                    if ($magCategoryConditions) {
                        if ($magCategoryConditions[1] === 'IN') {
                            $query->whereIn($magCategoryConditions[0], $magCategoryConditions[2]);
                        } else {
                            $query->where($magCategoryConditions[0], $magCategoryConditions[1], $magCategoryConditions[2]);
                        }
                    }
                })
                ->where(function ($query) use ($languageConditions) {
                    if ($languageConditions) {
                        if ($languageConditions[1] === 'IN') {
                            $query->whereIn($languageConditions[0], $languageConditions[2]);
                        } else {
                            $query->where($languageConditions[0], $languageConditions[1], $languageConditions[2]);
                        }
                    }
                })
                ->where('deleted', 0)
                ->with('edition')
                ->orderBy('Title')
                ->get();
            $magazineOptions = $this->generateSelectOptions($magazines);
            
            $magazinesAll = PubMaster::on('mysql2')->where('PrimaryPubId', 0)
                ->where('type', 229)
                ->whereNotIn('PubId', $magazines->pluck('PubId'))
                ->where('deleted', 0)
                ->with('edition')
                ->orderBy('Title')
                ->get();

            $magazineAllOptions = $this->generateSelectOptions($magazinesAll);

            return response()->json([
                'news' => $newsOptions,
                'magazine' => $magazineOptions,
                'newsAll' => $newsAllOptions,
                'magazineAll' => $magazineAllOptions
            ]);
        }
    }

    private function handleEditions($editions)
    {
        if (!empty($editions) && $editions != -1) {
            $editionsArray = explode(",", $editions);
            $conditions = [];
            foreach ($editionsArray as $edition) {
                switch ($edition) {
                    case "-8":
                        $conditions[] = ['Place', 'IN', [1, 232, 233, 156, 450, 157, 531, 206]];
                        break;
                    case "-6":
                        $conditions[] = ['Place', 'IN', [1, 232, 233, 156, 450, 157]];
                        break;
                    default:
                        $conditions[] = ['Place', '=', $edition];
                }
            }
            return $conditions;
        } else {
            return [];
        }
    }

    private function handleCategoryCondition($categories)
    {
        if (!empty($categories) && $categories != -1) {
            $categoriesArray = explode(",", $categories);
            return ['Category', 'IN', $categoriesArray];
        } elseif (!empty($categories) && $categories == -1) {
            return [];
        } else {
            return ['Category', '=', -420];
        }
    }

    private function handleLanguages($languages)
    {
        if (!empty($languages) && $languages != -1) {
            $languagesArray = explode(",", $languages);
            return ['Language', 'IN', $languagesArray];
        } else {
            return [];
        }
    }

    private function generateSelectOptions($results)
    {
        if ($results->count() > 0) {
            $options = '<select size="4" style="width:200px;" multiple="multiple">';
            foreach ($results as $result) {
                $style = $result->IsMain ? "style='background-color:yellow;'" : '';
                $options .= '<option value="' . $result->PubId . '" ' . $style . '>' . $result->Title . ' (' . $result->edition->Name . ')</option>';
            }
            $options .= '</select>';
        } else {
            $options = '<select size="4" style="width:200px;" multiple="multiple"><option value="-420">Sorry No Records Found</option></select>';
        }
        return $options;
    }
    public function saveselecteddata(Request $request)
    {
       
        $clientId = $request->input('clientid');
        DB::beginTransaction();
        try {
                // Delete old records
                MediaUniverse::where('clientid', $clientId)->delete();
                MediaUniverseMaster::where('clientid', $clientId)->delete();
             
                // Handle editions
                if ($request->has('edition')) {
                 
                    $editionsArr = explode(",", $request->input('edition'));
                 
                    foreach ($editionsArr as $edition) {
                        $tag = $this->getEditionTag($edition);
                        MediaUniverse::create([
                            'clientid' => $clientId,
                            'type' => 'Edition',
                            'tag' => $tag,
                            'tagid' => $edition
                        ]);
                        $this->insertCityIds($clientId, $tag, $edition);
                    }
                }

                // Handle languages
                if ($request->has('language')) {
                    $languagesArr = explode(",", $request->input('language'));
              
                    foreach ($languagesArr as $language) {
                        $tag = ($language == '-1' ? 'A' : 'P');
                      
                        MediaUniverse::create([
                            'clientid' => $clientId,
                            'type' => 'Language',
                            'tag' => $tag,
                            'tagid' => $language
                        ]);
                    }
                }

                // Handle newspaper categories
                $this->handleCategories($request->input('newspapercat'), $clientId, 'Newspaper', 'B');
                // Handle magazine categories
                $this->handleCategories($request->input('magzinecat'), $clientId, 'Magazine', 'B');

                // Handle newspapers
                if ($request->has('newsPaper')) {
                    $this->handlePublications($request->input('newsPaper'), $clientId, 230, 'Newspaper');
                }

                // Handle magazines
                if ($request->has('magzine')) {
                    $this->handlePublications($request->input('magzine'), $clientId, 229, 'Magazine');
                }
               
            DB::commit();
            Log::info('Media universe updated successfully clientid is :client_id and user is :user', ['client_id' => $clientId, 'user' => request('user')]);
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack(); 
            $errorMessage = 'Error updating media universe: ' . $e->getMessage();
            Log::error($errorMessage, ['client_id' => $clientId]);
            $this->sendErrorEmail($e->getMessage(), $clientId);
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function getEditionTag($edition)
    {
        switch ($edition) {
            case "-1":
                return 'A';
            case "-6":
                return '6P';
            case "-8":
                return '8P';
            default:
                return 'P';
        }
    }

    private function insertCityIds($clientId, $tag, $edition)
    {
        $cityIds = [];
        if ($tag == '8P') {
            $cityIds = [1, 232, 233, 156, 450, 157, 531, 206];
        } elseif ($tag == '6P') {
            $cityIds = [1, 232, 233, 156, 450, 157];
        }

        foreach ($cityIds as $cityId) {
            MediaUniverse::create([
                'clientid' => $clientId,
                'type' => 'Edition',
                'tag' => 'P',
                'tagid' => $cityId
            ]);
        }
    }

    private function handleCategories($categories, $clientId, $type, $defaultTag)
    {
        if (!empty($categories)) {
            $categoriesArr = explode(",", $categories);
          
            foreach ($categoriesArr as $category) {
                MediaUniverse::create([
                    'clientid' => $clientId,
                    'type' => $type,
                    'tag' => $defaultTag,
                    'tagid' => $category
                ]);
            }
        } else {
            MediaUniverse::create([
                'clientid' => $clientId,
                'type' => $type,
                'tag' => 'P',
                'tagid' => '-2'
            ]);
        }
    }

    private function handlePublications($publications, $clientId, $type, $tag)
    {
        $publicationsArr = explode(",", $publications);
        $allPublications = Pubmaster::where('Type', $type)
            ->where('PrimaryPubID', 0)
            ->where('deleted', 0)
            ->pluck('PubId')
            ->toArray();

        if (count($allPublications) != count($publicationsArr)) {
            foreach ($publicationsArr as $publication) {
                if ($publication != '-420' && $publication != ' ') {
                    MediaUniverse::create([
                        'clientid' => $clientId,
                        'type' => $tag,
                        'tag' => 'P',
                        'tagid' => $publication
                    ]);

                    MediaUniverseMaster::create([
                        'clientid' => $clientId,
                        'pubId' => $publication
                    ]);

                    $supplements = PubMaster::where('primaryPubId', $publication)
                        ->where('deleted', 0)
                        ->pluck('PubId')
                        ->toArray();

                    foreach ($supplements as $supplement) {
                        MediaUniverseMaster::create([
                            'clientid' => $clientId,
                            'pubId' => $supplement
                        ]);
                    }
                }
            }
        } else {
            MediaUniverse::create([
                'clientid' => $clientId,
                'type' => $tag,
                'tag' => 'A',
                'tagid' => '-1'
            ]);

            foreach ($allPublications as $publication) {
                MediaUniverseMaster::create([
                    'clientid' => $clientId,
                    'pubId' => $publication
                ]);

                $supplements = PubMaster::where('primaryPubId', $publication)
                    ->where('deleted', 0)
                    ->pluck('PubId')
                    ->toArray();

                foreach ($supplements as $supplement) {
                    MediaUniverseMaster::create([
                        'clientid' => $clientId,
                        'pubId' => $supplement
                    ]);
                }
            }
        }
    }

    private function sendErrorEmail($message, $clientId)
    {
        $to = ["shkhan@impactmeasurement.co.in", "rsharma@impactmeasurement.co.in"];
        $subject = "Media universe query error with client'".$clientId."'";
        $from = "helpdesk@impactmeasurement.co.in";

        Mail::raw($message, function ($mail) use ($to, $subject, $from) {
            $mail->from($from)
                 ->to($to)
                 ->subject($subject);
        });
    }
}
