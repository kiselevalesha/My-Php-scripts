<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/click.php');
    
    class DBClick extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Clicks", $idDb);
            
            $this->strFields = 'isDeleted,strUrlFrom,strUrlTo,strActivity,strPage,strDiv,strView,strValue,strDescription,strError,idEssentialAuthor,idAuthor,ageChanged';
            $this->Init("Clicks", $idDb);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("strUrlFrom", $obj->strUrlFrom);
            $this->AddContentValue("strUrlTo", $obj->strUrlTo);
            $this->AddContentValue("strActivity", $obj->strActivity);
            $this->AddContentValue("strPage", $obj->strPage);
            $this->AddContentValue("strDiv", $obj->strDiv);
            $this->AddContentValue("strView", $obj->strView);
            $this->AddContentValue("strValue", $obj->strValue);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strError", $obj->strError);
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
            $obj = new Client();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->strUrlFrom = $row[$i++];
            $obj->strUrlTo = $row[$i++];
            $obj->strActivity = $row[$i++];
            $obj->strPage = $row[$i++];
            $obj->strDiv = $row[$i++];
            $obj->strView = $row[$i++];
            $obj->strValue = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strError = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
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