<?php
namespace AppBundle\Utils;

class CaculateDays {
    public function daysDifference($dateFrom, $dateTo){
        $dateFrom = strtotime($dateFrom, 0);
        $dateTo = strtotime($dateTo, 0);
        return $dateTo - $dateFrom;
    }

    public function datediff($array)
    {
        $interval           = $array['interval'];
        $dateFrom           = $array['dateFrom'];
        $dateTo             = $array['dateTo'];
        $timetype           = $array['timetype'];

        $difference = $this->daysDifference($dateFrom, $dateTo);
            switch ($interval) {
                case "d":
                default:
                    switch ($timetype) {
                        case 1: // hours difference
                            $diff = floor($difference / 3600);
                            break;
                        case 2: // mins difference
                            $diff = floor($difference / 60);
                            break;
                        case 3: // seconds difference
                            $diff = floor($difference);
                            break;
                        case 0:
                        default: // days difference
                            $diff = floor($difference / 86400);
                            break;
                    }
                    break;
                case "wd":
                    $diff = $this->caculateWeekDays($dateFrom, $dateTo, $timetype);
                    break;
                case "cw":
                    $diff = floor($difference / 604800);
                    break;
            }
            return $diff;
    }

    /*
    *  caculate working days, hours, minutes or seconds ignore holidays
    *  return number of working days, hours, minutes or seconds
    */
    public function caculateWeekDays($dateFrom, $dateTo, $timetype){
        $dateFrom = strtotime($dateFrom);
        $dateTo = strtotime($dateTo);
        $different = $dateTo - $dateFrom;
        $daysDiff = floor($different / (60*60*24));
        $weeksDiff = floor($daysDiff / 7);

        $dateFrom = strtotime($dateFrom, 0);
        $dateTo = strtotime($dateTo, 0);

        $firstDay = date("w", $dateFrom);
        $dateLeft = floor($daysDiff % 7);
        $odays = $firstDay + $dateLeft;

        if ($odays > 7) {
            $dateLeft--;
        }
        if ($odays > 6) {
            $dateLeft--;
        }

        $result = $weeksDiff * 5 + $dateLeft; // weekdays

        if ($timetype) {
            $firstDayHours = date("G", $dateFrom);
            $firstDayMins = date("i", $dateFrom);
            $firstDaySeconds = date("s", $dateFrom);

            $lastDayHours = date("G", $dateTo);
            $lastDayMins = date("i", $dateTo);
            $lastDaySeconds = date("s", $dateTo);

            $result = $result * 24 - $firstDayHours + $lastDayHours;
            switch ($timetype) {
                case 2:
                    $result = $result * 60 - $firstDayMins + $lastDayMins;
                    break;
                case 3:
                    $result = ($result * 60 - $firstDayMins + $lastDayMins) * 60 - $firstDaySeconds
                + $lastDaySeconds;
                    break;
                case 1:
                default:
                    break;
            }
        }
        return $result;
    }
}

