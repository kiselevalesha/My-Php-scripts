<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/codeAppointment.php');

    class DBCodeAppointment extends DBBase {

        public function __construct()
        {
            //$this->DropTable("CodeAppointments", "");
            
            $this->strFields = 'longCode,idDB,idSalon,idEmployee,idAppointment,isFinishedStep1,isFinishedStep2,isFinishedStep3,isFinishedStep4,ageChanged';
            $this->arraIndexFields = array("longCode");
            $this->Init("CodeAppointments", "");
        }

        public function Add($idDB, $idSalon, $idEmployee) {
            $obj = new CodeAppointment();
            $obj->idDB = $idDB;
            $obj->idSalon = $idSalon;
            if (!empty($idSalon))   $obj->isFinishedStep1 = 1;
            $obj->idEmployee = $idEmployee;
            if (!empty($idEmployee))   $obj->isFinishedStep2 = 1;
            //$obj->idAppointment = idAppointment;
            $obj->id = $this->Save($obj);
            
            $obj->GenerateCode();
            $obj->id = $this->Save($obj);
            return $obj;
        }
        
        public function GetByCode($strCode) {
            $codeAppointmentTemp = new CodeAppointment();
            $idCodeAppointment = $codeAppointmentTemp->GetIdByCode($strCode);
            $codeAppointment = $this->Get($idCodeAppointment);
            return $codeAppointment;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("longCode", $obj->longCode);
            $this->AddContentValue("idDB", $obj->idDB);
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("idAppointment", $obj->idAppointment);
            $this->AddContentValue("isFinishedStep1", $obj->isFinishedStep1);
            $this->AddContentValue("isFinishedStep2", $obj->isFinishedStep2);
            $this->AddContentValue("isFinishedStep3", $obj->isFinishedStep3);
            $this->AddContentValue("isFinishedStep4", $obj->isFinishedStep4);
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
            $obj = new CodeAppointment();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->longCode = $row[$i++];
            $obj->idDB = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->idAppointment = $row[$i++];
            $obj->isFinishedStep1 = $row[$i++];
            $obj->isFinishedStep2 = $row[$i++];
            $obj->isFinishedStep3 = $row[$i++];
            $obj->isFinishedStep4 = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
    }

?>