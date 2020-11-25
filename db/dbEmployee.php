<?
    include_once('../php-scripts/db/dbUser.php');
    include_once('../php-scripts/models/employee.php');
    
    class DBEmployee extends DBUser {

        public function __construct($idDb)
        {
            //$this->DropTable("Employees", $idDb);
            $this->Init("Employees", $idDb);
        }

        public function New() {
            $obj = new Employee();
            $obj->id = $this->Save($obj);
            return $obj;
        }
        
        public function GetEmployee($id) {
            $obj = new Employee();
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
            $this->AddContentValue("strPromoCode", $obj->strPromoCode);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id == 0) {
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
            $obj = new Employee();
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
            $obj->strPromoCode = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->idMainPhoto = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function GetDefault() {
            return $this->Get($this->GetIdDefault());
        }
        public function GetIdDefault() {
            $base = $this->GetRowBySql("isUse=1 AND isDeleted=0");     //"id=1"
            if (empty($base->id)) {
                $base = $this->New();
            }
            //echo "GetDefault  base->id=".$base->id;
            return $base->id;
        }
        
        public function MakeJson($obj) {
            return $obj->MakeJson();
            /*'"id":"'.$obj->id.'",'
                .'"name":"'.$obj->strName.'",'
                //.'"description":"'.$obj->strDescription.'",'
                .'"changed":'.$obj->ageChanged;*/
        }
    }

?>