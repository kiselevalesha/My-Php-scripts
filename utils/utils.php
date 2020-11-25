<?
    include_once('../php-scripts/utils/age.php');
    
    function GetTwoNumbers($num) {
        $num = $num + 0;
        if ($num < 10)  return "0".$num;
        return "".$num;
    }

    function GetLastDigit($num) {
        $num = 0 + $num;
        while($num > 10) {
            $num = $num - floor($num / 10) * 10;
        }
        return $num;
    }
    
    
    function GetLastSlog($num, $end1, $end2, $end3) {
        switch(GetLastDigit($num)) {
            case 1:
                return $end1;
            case 2:
            case 3:
            case 4:
                return $end2;
            /*case 0:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:*/
            default:
                return $end3;
        }
    }

    
    
    function SendEmailFromZapisi($to, $subject, $body) {
        SendEmailBase($to, $subject, $body, 'From: Записи.онлайн <assistent@записи.онлайн>');
    }
    
    function SendEmail($to, $subject, $body) {
        SendEmailBase($to, $subject, $body, 'From: Записи.онлайн <report@beautymasters.site>');
    }
    
    function SendEmailBase($to, $subject, $body, $from) {
        $message = '<html><head></head><body>'.$body.'</body></html>';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= $from . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    function SendUniversalEmail($to, $subject, $body) {
        $pos = strpos($to, '@gmail.com') + strpos($to, '@mail.ru');
        if ($pos) {
            SendEmailBase($to, $subject, $body, 'From: Записи.онлайн <assistent@talon24.ru>');
        }
        else {
            SendEmailBase($to, $subject, $body, 'From: Записи.онлайн <assistent@записи.онлайн>');
        }
    }

?>