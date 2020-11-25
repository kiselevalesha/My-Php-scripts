<?

class Age
{
    public $years = 0;
    public $months = 0;
    public $days = 0;
    public $hours = 0;
    public $minutes = 0;
    public $seconds = 0;

    public function SetNow() {
        $date = new DateTime();
        $tics = $date->format("YmdHis");
        $this->SetAge($tics);
    }

    public function SetAge($age) {
        $this->years = substr($age, 0, 4) + 0;
        $this->months = substr($age, 4, 2) + 0;
        $this->days = substr($age, 6, 2) + 0;
        $this->hours = substr($age, 8, 2) + 0;
        $this->minutes = substr($age, 10, 2) + 0;
        $this->seconds = substr($age, 12, 2) + 0;
    }

    public function SetDateTime($date, $time) {
        $this->years = substr($date, 0, 4) + 0;
        $this->months = substr($date, 4, 2) + 0;
        $this->days = substr($date, 6, 2) + 0;
        $this->hours = substr($time, 0, 2) + 0;
        $this->minutes = substr($time, 2, 2) + 0;
        $this->seconds =  0;
    }

    public function MakeAge($years, $months, $days, $hours, $minutes, $seconds) {
        $this->years = $years;
        $this->months = $months;
        $this->days = $days;
        $this->hours = $hours;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }

    public function GetObjectAge() {
        $age = new Age();
        $age->years = $this->years;
        $age->months = $this->months;
        $age->days = $this->days;
        $age->hours = $this->hours;
        $age->minutes = $this->minutes;
        $age->seconds = $this->seconds;
        return $age;
    }

    public function GetLongAge() {
        return ($this->years * 10000 + $this->months * 100 + $this->days) * 1000000 + $this->hours * 10000 + $this->minutes * 100 + $this->seconds;
    }

    public function AddToAge($years, $months, $days, $hours, $minutes, $seconds) {
        if (($years == 0) && ($months == 0) && ($days == 0) && ($hours == 0) && ($minutes == 0) && ($seconds == 0)) return;

        $date = new DateTime();
        $date->setDate($this->years, $this->months, $this->days);
        $date->setTime($this->hours, $this->minutes);
        
        $str = '';
        if ($years > 0) $str .= $years.'Y';
        if ($months > 0) $str .= $months.'M';
        if ($days > 0) $str .= $days.'D';
        if (($hours > 0) || ($minutes > 0) || ($seconds > 0)) {
            $str .= 'T';
            if ($hours > 0) $str .= $hours.'H';
            if ($minutes > 0) $str .= $minutes.'M';
            if ($seconds > 0) $str .= $seconds.'S';
        }
        if (strlen($str) > 0) {
            $interval = new DateInterval('P'.$str);
            $date->add($interval);
        }
        
        $str = '';
        if ($years < 0) $str .= abs($years).'Y';
        if ($months < 0) $str .= abs($months).'M';
        if ($days < 0) $str .= abs($days).'D';
        if (($hours < 0) || ($minutes < 0) || ($seconds < 0)) {
            $str .= 'T';
            if ($hours < 0) $str .= abs($hours).'H';
            if ($minutes < 0) $str .= abs($minutes).'M';
            if ($seconds < 0) $str .= abs($seconds).'S';
        }
        if (strlen($str) > 0) {
            $interval = new DateInterval('P'.$str);
            $date->sub($interval);
        }

        $this->years = $date->format("Y");
        $this->months = $date->format("n");
        $this->days = $date->format("j");
        $this->hours = $date->format("H");
        $this->minutes = $date->format("i");
        $this->seconds = $date->format("s");
    }

    public function GetCountDaysInMonth($year, $month) {
        switch(0+$month) {
            case 1: return 31;
            case 2:
                $dif = abs(2020 - $year);
                $xxx = floor($dif / 4);
                $ost = $dif - $xxx * 4;
                if ($ost == 0)  return 29;
                return 28;
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

}
?>