<?php
function getCompanyScore($keyword)
{

        foreach ($keyword as $key) {
                if ($key['keytpe'] == 'My Company Keyword') {
                        if (trim($key['Prominence']) == 'headline mention' or trim($key['Prominence']) == 'prominent') {
                                return 10;
                                break;
                        } else {
                                return 0;
                                break;
                        }
                }
        }

        return 0;

}

function getIndustryScore($keyword)
{

        foreach ($keyword as $key) {
                if ($key['keytpe'] == 'My Industry Keyword') {
                        if (trim($key['Prominence']) == 'headline mention' or trim($key['Prominence']) == 'prominent') {
                                return 10;
                                break;
                        } else {
                                return 0;
                                break;
                        }
                }
        }

        return 0;

}

function getCompetitionScore($keyword)
{

        foreach ($keyword as $key) {
                if ($key['keytpe'] == 'My Competitor Keyword') {
                        if (trim($key['Prominence']) == 'headline mention' or trim($key['Prominence']) == 'prominent') {
                                return 10;
                                break;
                        } else {
                                return 0;
                                break;
                        }
                }
        }

        return 0;

}