<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/ownerService.php');

    class DBEmployeeService extends DBBase {

        public function __construct()
        {
            //$this->DropTable("EmployeeServices", "");
            
            $this->strFields = 'idSalon,idEmployee,idService,isChecked,idEssentialAuthor,idAuthor,ageChanged';
            $this->arraIndexFields = array("idSalon", "idEmployee", "idService");
            $this->Init("EmployeeServices", "");
        }

        public function GetChecked($idSalon, $idEmployee, $idService) {
            return $this->GetIntField("isChecked", "idService=".$idService." AND idEmployee=".$idEmployee." AND idSalon=".$idSalon);
        }

        public function Update($idSalon, $idEmployee, $idService) {
            $obj = new OwnerService();
            $obj->idSalon = $idSalon;
            $obj->idEmployee = $idEmployee;
            $obj->idService = $idService;
            $obj->isChecked = 1;
            $obj->id = $this->SaveUpdate($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("idService", $obj->idService);
            $this->AddContentValue("isChecked", $obj->isChecked);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id == 0) {
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
            $obj = new OwnerService();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->idService = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->isChecked = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function GetId($obj) {
            return $this->GetIdField("idEmployee=".$obj->idEmployee." AND idService=".$obj->idService." AND idSalon=".$obj->idSalon);
        }

        public function SaveUpdate($obj) {
            $obj->id = $this->GetId($obj);
            return $this->Save($obj);
        }
        
    }

?>