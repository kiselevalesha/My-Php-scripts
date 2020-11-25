<?

    function GetSympleDateTime($tics) {
        $dateTime = new DateTime();
        $dateTime->setTimestamp($tics);
        return $dateTime->format('YmdHis');
    }
    
    function FormatDateTime($dateTimeLong) {
        return "".FormatDate($dateTimeLong)." ".FormatLongTime($dateTimeLong);
        //substr($dateTimeLong,0,4).".".substr($dateTimeLong,4,2).".".substr($dateTimeLong,6,2)." ".substr($dateTimeLong,8,2).":".substr($dateTimeLong,10,2).":".substr($dateTimeLong,12,2);
    }
    function FormatDate($dateTimeLong) {
        return "".substr($dateTimeLong,0,4).".".substr($dateTimeLong,4,2).".".substr($dateTimeLong,6,2);
    }
    function FormatLongTime($dateTimeLong) {
        return "".substr($dateTimeLong,8,2).":".substr($dateTimeLong,10,2).":".substr($dateTimeLong,12,2);
    }
    function FormatShortTime($dateTimeLong) {
        return "".substr($dateTimeLong,8,2).":".substr($dateTimeLong,10,2);
    }
    function GetTimeFormat($time) {
        $hours = floor($time / 100);
        $minutes = $time - $hours * 100; 
        return GetTwoNumbers($hours).":".GetTwoNumbers($minutes);
    }
    
    function GetTimeAddMinutes($time, $addMinutes) {
        $hours = floor($time / 100);
        $minutes = $time - $hours * 100 + $addMinutes;
        while ($minutes >= 60) {
            $minutes -= 60;
            $hours++;
        }
        return $hours * 100 + $minutes;
    }
    
    function GetRusNameMonth($month) {
        $strMonth = "";
        switch(0+$month) {
            case 1: $strMonth = "Январь"; break;
            case 2: $strMonth = "Февраль"; break;
            case 3: $strMonth = "Март"; break;
            case 4: $strMonth = "Апрель"; break;
            case 5: $strMonth = "Май"; break;
            case 6: $strMonth = "Июнь"; break;
            case 7: $strMonth = "Июль"; break;
            case 8: $strMonth = "Август"; break;
            case 9: $strMonth = "Сентябрь"; break;
            case 10: $strMonth = "Октябрь"; break;
            case 11: $strMonth = "Ноябрь"; break;
            case 12: $strMonth = "Декабрь"; break;
        }
        return $strMonth;
    }
    
    function GetCountDaysInMonth($month) {
        switch(0+$month) {
            case 1: return 31;
            case 2: return 28;
            case 3: return 31;
            case 4: return 30;
            case 5: return 31;
            case 6: return 30;
            case 7: return 31;
            case 8: return 31;
            case 9: return 30;
            case 10: return 31;
            case 11: return 30;
            case 12: return 31;
        }
        return 0;
    }

?>
