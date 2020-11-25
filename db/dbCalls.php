<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/call.php');
    
    class DBCall extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Calls", $idDb);
            $this->Init("Calls", $idDb);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("ageStartCall", $obj->ageStartCall);
            $this->AddContentValue("ageStartTalk", $obj->ageStartTalk);
            $this->AddContentValue("ageEndTalk", $obj->ageEndTalk);
            
            $this->AddContentValue("strPhoneTo", $obj->strPhoneTo);
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idMaster", $obj->idMaster);
            
            $this->AddContentValue("strPhoneFrom", $obj->strPhoneFrom);
            $this->AddContentValue("idClient", $obj->idClient);
            $this->AddContentValue("idOperator", $obj->idOperator);

            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id < 1) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($obj->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($obj->id < 1)   $obj->id = $this->GetInsertedId();
            return $obj->id;
        }

        public function GetRow($row) {
            $obj = new Call();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->ageStartCall = $row[$i++];
            $obj->ageStartTalk = $row[$i++];
            $obj->ageEndTalk = $row[$i++];
            $obj->strPhoneTo = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idMaster = $row[$i++];
            $obj->strPhoneFrom = $row[$i++];
            $obj->idClient = $row[$i++];
            $obj->idOperator = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                //.'"name":"'.$obj->strName.'",'
                //.'"description":"'.$obj->strDescription.'",'
                .'"changed":'.$obj->ageChanged;
        }
    }

?>