<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/tax.php');
    
    class DBTax extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Taxes", $idDb);
            $this->Init("Taxes", $idDb);
        }

        public function New() {
            $obj = new Tax();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            //$this->AddContentValue("isDeleted", $obj->isDeleted);
            $this->AddContentValue("idForCalculation", $obj->idForCalculation);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("idTypePeriod", $obj->idTypePeriod);
            $this->AddContentValue("isTaxAddToPrice", $obj->isTaxAddToPrice);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("idColor", $obj->idColor);
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
            $obj = new Tax();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idForCalculation = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->idTypePeriod = $row[$i++];
            $obj->isTaxAddToPrice = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->idColor = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                .'"name":"'.$obj->strName.'",'
                .'"description":"'.$obj->strDescription.'",'
                //.'"essential":{"id":'.$obj->idEssential.',"name":'.EnumEssential::GetNameEssentialRussian($obj->idEssential).'"},'
                //.'"type":{"id":'.$obj->idType.',"name":'.Group::GetNameTypeRussian($obj->idType).'"},'
                //.'"color":'.$obj->idColor.','
                .'"changed":'.$obj->ageChanged;
        }
    }

?>