<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/adress.php');
    
    class DBAdress extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Adress", $idDb);
            $this->Init("Adress", $idDb);
        }

        public function New() {
            $obj = new Adress();
            $obj->id = $this->Save($obj);
            return $obj;
        }
        
        public function GetAdress($id) {
            $obj = new Adress();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }
        
        public function GetIdAdress($idOwner, $idEssential) {
            return $this->GetIdField("idOwner=".$idOwner." AND idEssential=".$idEssential." AND isDeleted=0");
        }

        public function Save($obj) {
            $this->CreateContentValue();
            //$this->AddContentValue("isDeleted", $obj->isDeleted);
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("floatLatitude", $obj->floatLatitude);
            $this->AddContentValue("floatLongitude", $obj->floatLongitude);
            $this->AddContentValue("strPostIndex", $obj->strPostIndex);
            $this->AddContentValue("strCountry", $obj->strCountry);
            $this->AddContentValue("strRegion", $obj->strRegion);
            $this->AddContentValue("strCity", $obj->strCity);
            $this->AddContentValue("strStreet", $obj->strStreet);
            $this->AddContentValue("strHouse", $obj->strHouse);
            $this->AddContentValue("strCorpus", $obj->strCorpus);
            $this->AddContentValue("strAppartment", $obj->strAppartment);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strMetro1", $obj->strMetro1);
            $this->AddContentValue("strMetro2", $obj->strMetro2);
            $this->AddContentValue("strMetro3", $obj->strMetro3);
            $this->AddContentValue("idCategory", $obj->idCategory);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id == 0) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($obj->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($obj->id == 0)   $obj->id = $this->GetInsertedId();
            return $obj->id;
        }

        public function GetRow($row) {
            $obj = new Adress();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->floatLatitude = $row[$i++];
            $obj->floatLongitude = $row[$i++];
            $obj->strPostIndex = $row[$i++];
            $obj->strCountry = $row[$i++];
            $obj->strRegion = $row[$i++];
            $obj->strCity = $row[$i++];
            $obj->strStreet = $row[$i++];
            $obj->strHouse = $row[$i++];
            $obj->strCorpus = $row[$i++];
            $obj->strAppartment = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strMetro1 = $row[$i++];
            $obj->strMetro2 = $row[$i++];
            $obj->strMetro3 = $row[$i++];
            $obj->idCategory = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
    }

?>