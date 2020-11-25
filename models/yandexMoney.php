<?

class YandexMoney
{
    public $id = 0;
    public $strUniqKey = 0;
    public $strDescription = '';
    public $ageRequest = 0;
    public $agePayed = 0;
    public $idDB = 0;
    public $idEmployee = 0;
    public $summaRequest = 0;
    public $summaPayed = 0;
    public $isPayed = 0;

    public function ToJson() {
        return '{"id":"'.$this->id.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"key":'.$this->strUniqKey.','
            .'"start":'.$this->ageRequest.','
            .'"end":'.$this->agePayed.','
            .'"DB":'.$this->idDB.','
            .'"employee":'.$this->idEmployee.','
            .'"$summaRequest":'.$this->summaRequest.','
            .'"$summaPayed":'.$this->summaPayed.','
            .'"isPayed":'.$this->isPayed.'}';
    }
}
?>