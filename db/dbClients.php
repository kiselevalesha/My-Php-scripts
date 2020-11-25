<?
    include_once('../php-scripts/db/dbUser.php');
    include_once('../php-scripts/models/client.php');
    
    class DBClient extends DBUser {

        public function __construct($idDb)
        {
            //$this->DropTable("Clients", $idDb);
            //$this->arrayIndexFields = array("strName", "strSurName");
            $this->Init("Clients", $idDb);
        }

        public function New() {
            $obj = new Client();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetClient($id) {
            $obj = new Client();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function GetId($obj) {
            $sql = "";
            if (! empty($obj->strName))
               $sql .= "strName LIKE '".$obj->strName."' AND ";
            
            if (! empty($obj->strSurName))
               $sql .= "strSurName LIKE '".$obj->strSurName."' AND ";
            
            if (! empty($obj->strPatronymic))
               $sql .= "strPatronymic LIKE '".$obj->strPatronymic."' AND ";
            
            $sql .= " isDeleted=0";
            return $this->GetIdField($sql);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strSurName", $obj->strSurName);
            $this->AddContentValue("strPatronymic", $obj->strPatronymic);
            $this->AddContentValue("strAlias", $obj->strAlias);
            $this->AddContentValue("strToken", $obj->strToken);
            $this->AddContentValue("strYandexToken", $obj->strYandexToken);
            $this->AddContentValue("strVKToken", $obj->strVKToken);
            $this->AddContentValue("dateBorn", $obj->dateBorn);
            $this->AddContentValue("idSex", $obj->idSex);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("intPeriodDays", $obj->intPeriodDays);
            $this->AddContentValue("isAutoCalcPeriod", $obj->isAutoCalcPeriod);
            $this->AddContentValue("idCategory", $obj->idCategory);
            $this->AddContentValue("idReklama", $obj->idReklama);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("ageFirstVisit", $obj->ageFirstVisit);
            $this->AddContentValue("ageLastVisit", $obj->ageLastVisit);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id == 0) {
                $this->AddContentValue("ageCreated", $this->NowLong());
                $this->AddContentValue("isDeleted", $obj->isDeleted);
                $this->AddContentValue("idMainPhoto", $obj->idMainPhoto);   //  Это не надо перезаписывать постоянно !!! Оно сохраняется отдельно !
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
            $obj->strName = $row[$i++];
            $obj->strSurName = $row[$i++];
            $obj->strPatronymic = $row[$i++];
            $obj->strAlias = $row[$i++];
            $obj->strToken = $row[$i++];
            $obj->strYandexToken = $row[$i++];
            $obj->strVKToken = $row[$i++];
            $obj->dateBorn = $row[$i++];
            $obj->idSex = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->intPeriodDays = $row[$i++];
            $obj->isAutoCalcPeriod = $row[$i++];
            $obj->idCategory = $row[$i++];
            $obj->idMainPhoto = $row[$i++];
            $obj->idReklama = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->ageCreated = $row[$i++];
            $obj->ageFirstVisit = $row[$i++];
            $obj->ageLastVisit = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function MakeJson($obj) {
            return $obj->MakeJson();
        }
    }

?>