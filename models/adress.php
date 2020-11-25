<?
include_once('../php-scripts/models/base.php');

class Adress extends Base
{
    public $idEssential = 0;
    public $idOwner = 0;
    
    public $floatLatitude = 0;
    public $floatLongitude = 0;
    
    public $strPostIndex = '';
    public $strCountry = '';
    public $strRegion = '';
    public $strCity = '';
    public $strStreet = '';
    public $strHouse = '';
    public $strCorpus = '';
    public $strAppartment = '';
    public $strDescription = '';
    
    public $strMetro1 = '';
    public $strMetro2 = '';
    public $strMetro3 = '';
    
    public $idCategory = 0;
    
    public function MakeJson() {
        $str = '"id":'.$this->id.','
            .'"essential":'.$this->idEssential.','
            .'"owner":'.$this->idOwner;

        if ($this->floatLatitude > 0)
            $str .= ',"latitude":'.$this->floatLatitude;

        if ($this->floatLatitude > 0)
            $str .= ',"longitude":'.$this->floatLongitude;

        if (! empty($this->strPostIndex))
            $str .= ',"index":"'.$this->strPostIndex.'"';

        if (! empty($this->strCountry))
            $str .= ',"country":"'.$this->strCountry.'"';

        if (! empty($this->strRegion))
            $str .= ',"region":"'.$this->strRegion.'"';

        if (! empty($this->strCity))
            $str .= ',"city":"'.$this->strCity.'"';

        if (! empty($this->strStreet))
            $str .= ',"street":"'.$this->strStreet.'"';

        if (! empty($this->strHouse))
            $str .= ',"house":"'.$this->strHouse.'"';

        if (! empty($this->strCorpus))
            $str .= ',"corpus":"'.$this->strCorpus.'"';

        if (! empty($this->strAppartment))
            $str .= ',"appartment":"'.$this->strAppartment.'"';

        if (! empty($this->strDescription))
            $str .= ',"description":"'.$this->strDescription.'"';

        if (! empty($this->strMetro1))
            $str .= ',"metro1":"'.$this->strMetro1.'"';

        if (! empty($this->strMetro2))
            $str .= ',"metro2":"'.$this->strMetro2.'"';

        if (! empty($this->strMetro3))
            $str .= ',"metro3":"'.$this->strMetro3.'"';

        return $str;
    }
    
    public function ToString() {
        $str = "";

        if (! empty($this->strPostIndex))
            $str .= 'индекс:'.$this->strPostIndex.',';

        if (! empty($this->strCity))
            $str .= 'г.'.$this->strCity.',';

        if (! empty($this->strStreet))
            $str .= 'ул. '.$this->strStreet.',';

        if (! empty($this->strHouse))
            $str .= 'дом '.$this->strHouse.',';

        if (! empty($this->strCorpus))
            $str .= 'корпус '.$this->strCorpus.',';

        if (! empty($this->strAppartment))
            $str .= 'квартира '.$this->strAppartment;

        return $str;
    }
}
?>