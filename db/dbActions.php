<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/action.php');
    
    class DBAction extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Actions", $idDb);
            $this->Init("Actions", $idDb);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strPromoDescription", $obj->strPromoDescription);
            $this->AddContentValue("ageStartPeriod", $obj->ageStartPeriod);
            $this->AddContentValue("ageEndPeriod", $obj->ageEndPeriod);
            $this->AddContentValue("isSendMessage", $obj->isSendMessage);
            $this->AddContentValue("ageSendMessage", $obj->ageSendMessage);
            $this->AddContentValue("idCriterionSendMessage", $obj->idCriterionSendMessage);
            $this->AddContentValue("strBodyMessage", $obj->strBodyMessage);
            $this->AddContentValue("isShowOnline", $obj->isShowOnline);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
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
            $obj = new Action();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strPromoDescription = $row[$i++];
            $obj->ageStartPeriod = $row[$i++];
            $obj->ageEndPeriod = $row[$i++];
            $obj->isSendMessage = $row[$i++];
            $obj->ageSendMessage = $row[$i++];
            $obj->idCriterionSendMessage = $row[$i++];
            $obj->strBodyMessage = $row[$i++];
            $obj->isShowOnline = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>