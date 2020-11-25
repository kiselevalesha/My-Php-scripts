<?
    include_once('../php-scripts/db/dbBase.php');

    class DBMonth extends DBBase {

        public function __construct() { }

        public function GetNameById($iMonth) {
            switch($iMonth) {
                case 1: return "Январь";
                case 2: return "Февраль";
                case 3: return "Март";
                case 4: return "Апрель";
                case 5: return "Май";
                case 6: return "Июнь";
                case 7: return "Июль";
                case 8: return "Август";
                case 9: return "Сентябрь";
                case 10: return "Октябрь";
                case 11: return "Ноябрь";
                case 12: return "Декабрь";
            }
            return "";
        }
        
        public function GetRNameById($iMonth) {
            switch($iMonth) {
                case 1: return "Января";
                case 2: return "Февраля";
                case 3: return "Марта";
                case 4: return "Апреля";
                case 5: return "Мая";
                case 6: return "Июня";
                case 7: return "Июля";
                case 8: return "Августа";
                case 9: return "Сентября";
                case 10: return "Октября";
                case 11: return "Ноября";
                case 12: return "Декабря";
            }
            return "";
        }
        
    }
?>