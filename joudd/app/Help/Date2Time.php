<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 10/07/2019
 * Time: 12:27 Õ
 */

namespace App\Help;


class Date2Time
{
// if wanted to calculate start date - end date ($wantedToCalc=>start date ,$dateNow=>end date)
// if wanted to calculate start date - date of now  ($wantedToCalc=>start date ,null)

    public function calulatetime($wantedToCalc ,$dateNow=null)
    {
//        $wantedToCalc = strtotime("2018-07-02 09:42:49");
        $wantedToCalc = strtotime($wantedToCalc);
        if($dateNow != null)
            $dateNow =  strtotime($dateNow);
        $dateNow = strtotime(date("Y-m-d H:i:s")); //"2019-07-02 13:25:51"
        // Formulate the Difference between two dates
        $diff = abs($dateNow - $wantedToCalc);

        // To get the year divide the resultant date into
// total seconds in a year (365*60*60*24)
        $years = floor($diff / (365*60*60*24));

        // To get the month, subtract it with years and
// divide the resultant date into
// total seconds in a month (30*60*60*24)
        $months = floor(($diff - $years * 365*60*60*24)
            / (30*60*60*24));


// To get the day, subtract it with years and
// months and divide the resultant date into
// total seconds in a days (60*60*24)
        $days = floor(($diff - $years * 365*60*60*24 -
                $months*30*60*60*24)/ (60*60*24));
        // To get the hour, subtract it with years,
// months & seconds and divide the resultant
// date into total seconds in a hours (60*60)
//        $hours = floor(($diff - $years * 365*60*60*24
//                - $months*30*60*60*24 - $days*60*60*24)
//            / (60*60));

// Print the result
//        printf ("%d years, %d months, %d days, %d hours" , $years, $months,
//            $days, $hours);
        return[
            "years" => $years,
            "months" => $months,
            "days" => $days,
//            "hours" => $hours,
        ];

    }
}