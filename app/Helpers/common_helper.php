<?php

if (!function_exists('getInvestmentRange')) {
    function getInvestmentRange($investorDetails)
    {echo 'hello';die;
        $minInvestment = 0;
        $maxInvestment = 0;

        if (
            $investorDetails['invest_pref'] == 1 &&
            $investorDetails['full_acquisition'] == 1
        ) {
            $minInvestment = $investorDetails['invest_size_min'];
            $maxInvestment = $investorDetails['invest_size_max'];
        }

        if (
            $investorDetails['invest_pref'] == 1 &&
            $investorDetails['full_acquisition'] == 0
        ) {
            $minInvestment = $investorDetails['invest_size_min'];
            $maxInvestment = $investorDetails['invest_size_max'];
        }

        if (
            $investorDetails['invest_pref'] == 0 &&
            $investorDetails['full_acquisition'] == 1
        ) {
            $minInvestment = $investorDetails['purchase_capacity_min'];
            $maxInvestment = $investorDetails['purchase_capacity_max'];
        }

        $minInvestment = convertAmountToShort($minInvestment, 0);
        $maxInvestment = convertAmountToShort($maxInvestment, 0);

        return [$minInvestment, $maxInvestment];
    }
}


if (!function_exists('convertAmountToShort')) {
    function convertAmountToShort($rpVal, $decimalPoints)
    {
        if (!is_numeric($rpVal)) {
            return $rpVal;
        }

        if ($rpVal > 1000 && $rpVal < 100000) {
            $mod = round($rpVal / 1000, $decimalPoints);
            $rpVal = $mod . " Thousand";
        }

        if ($rpVal >= 100000 && $rpVal < 10000000) {
            $mod = round($rpVal / 100000, $decimalPoints);
            $rpVal = $mod . " Lakhs";
        }

        if ($rpVal >= 10000000) {
            $decimalPoints = ($decimalPoints == 0) ? 2 : $decimalPoints;
            $mod = round($rpVal / 10000000, $decimalPoints);
            $rpVal = $mod . " Crores";
        }

        return $rpVal;
    }
}
if (!function_exists('cleanSpecialChar')) {
    function cleanSpecialChar($string)
    {
        $specialCharacters = [
            '#' => '',
            '$' => '',
            '%' => '',
            '&' => '',
            '@' => '',
            '.' => '',
            '€' => '',
            '+' => '',
            '=' => '',
            '§' => '',
            '\\' => '',
            '/' => '',
        ];

        foreach ($specialCharacters as $character => $replacement) {
            $string = str_replace(
                $character,
                '-' . $replacement . '-',
                $string
            );
        }

        $string = preg_replace('/[^a-zA-Z0-9\-]/', ' ', $string);
        $string = preg_replace('/^[\-]+/', '', $string);
        $string = preg_replace('/[\-]+$/', '', $string);
        $string = preg_replace('/[\-]{2,}/', ' ', $string);

        return $string;
    }
    
}
if (!function_exists('getSlugUrl')) {
    function getSlugUrl($investor, $minInvestment, $maxInvestment)
    {
        $invTitleLoc = empty($investor['inv_city'])
            ? 'India'
            : $investor['inv_city'];

        $investorTitle = sprintf(
            config('constants.InvestorTitlePattern'),
            $invTitleLoc,
            $minInvestment,
            $maxInvestment
        );

        return !empty($investor['inv_headline'])
            ? $investor['inv_headline']
            : $investorTitle;
    }
}