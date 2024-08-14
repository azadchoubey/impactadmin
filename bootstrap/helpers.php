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

if (!function_exists('convertToPostfix')) {
    function convertToPostfix(array $conceptConditions)
    {
        $postfix = "";
        $stack = [];
        $top = -1;

        foreach ($conceptConditions as $item) {
            $item = trim($item);

            if (isElement($item)) {
                $postfix .= "|" . $item;
            } else {
                if ($item == ")") {
                    while (($o = array_pop($stack)) != "(" && $top > -1) {
                        if ($o != "(" && $o != ")") {
                            $postfix .= "|" . $o;
                        }
                        $top--;
                    }
                } else {
                    if (higherPrecedence($item, $stack)) {
                        array_push($stack, $item);
                        $top++;
                    } else {
                        while (!higherPrecedence($item, $stack) && $top > -1) {
                            $o = array_pop($stack);
                            if ($o != "(" && $o != ")") {
                                $postfix .= "|" . $o;
                            }
                            $top--;
                        }
                        array_push($stack, $item);
                        $top++;
                    }
                }
            }
        }

        while ($top > -1) {
            $postfix .= "|" . array_pop($stack);
            $top--;
        }

        return $postfix;
    }

    function isElement($item)
    {
        return !in_array(strtolower($item), ['and', 'or', 'not', ')', '(']);
    }

    function higherPrecedence($item, array $stack)
    {
        if (empty($stack)) {
            return true;
        }

        $top = end($stack);
        if ($top == "(") {
            return true;
        }

        if ($top == ")") {
            return false;
        }

        return true;
    }
}
