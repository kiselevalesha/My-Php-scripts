<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/salaryCalculations.php');
    
    class DBSalaryCalculations extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("SalaryCalculations", $idDb);
            $this->strFields = 'isDeleted,ageDay,idSalon,idEmployee,idPlace,idCurrency,summaAsMaster,summaAsAssistent,summaAsAdministartor,summaForPeriod,summaForRent,summaAsSeller,summaOnHands,summaBonus,summaPenalty,summaFix,isAutoCalculation,ageCalculated';
            $this->arraIndexFields = array("idSalon", "idEmployee");
            $this->Init("SalaryCalculations", $idDb);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("ageDay", $obj->ageDay);
            $this->AddContentValue("idSalon", $obj->idSalon);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("idPlace", $obj->idPlace);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("idCurrency", $obj->idCurrency);
            
            $this->AddContentValue("summaAsMaster", $obj->summaAsMaster);
            $this->AddContentValue("summaAsAssistent", $obj->summaAsAssistent);
            $this->AddContentValue("summaAsAdministartor", $obj->summaAsAdministartor);
            $this->AddContentValue("summaForPeriod", $obj->summaForPeriod);
            $this->AddContentValue("summaForRent", $obj->summaForRent);
            $this->AddContentValue("summaAsSeller", $obj->summaAsSeller);
            
            $this->AddContentValue("summaOnHands", $obj->summaOnHands);
            $this->AddContentValue("summaBonus", $obj->summaBonus);
            $this->AddContentValue("summaPenalty", $obj->summaPenalty);
            $this->AddContentValue("summaFix", $obj->summaFix);
            
            $this->AddContentValue("isAutoCalculation", $obj->isAutoCalculation);
            $this->AddContentValue("ageCalculated", $obj->ageCalculated);
            //$this->AddContentValue("ageCalculated", $this->NowLong());

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
            $obj = new Resource();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            
            $obj->ageDay = $row[$i++];
            $obj->idSalon = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->idPlace = $row[$i++];
            $obj->idCurrency = $row[$i++];
            
            $obj->summaAsMaster = $row[$i++];
            $obj->summaAsAssistent = $row[$i++];
            $obj->summaAsAdministartor = $row[$i++];
            $obj->summaForPeriod = $row[$i++];
            $obj->summaForRent = $row[$i++];
            $obj->summaAsSeller = $row[$i++];
            
            $obj->summaOnHands = $row[$i++];
            $obj->summaBonus = $row[$i++];
            $obj->summaPenalty = $row[$i++];
            $obj->summaFix = $row[$i++];
            
            $obj->isAutoCalculation = $row[$i++];
            $obj->ageCalculated = $row[$i++];
            return $obj;
        }
    }

?>