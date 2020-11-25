<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/criterion.php');
    
    class DBCriterion extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Criterions", $idDb);
            $this->Init("Criterions", $idDb);
        }

        public function New() {
            $obj = new Criterion();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetCriterion($id) {
            $obj = new Criterion();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            //$this->AddContentValue("isDeleted", $obj->isDeleted);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("idEssential", $obj->idEssential);
            
            $this->AddContentValue("idClientCategory", $obj->idClientCategory);
            $this->AddContentValue("idClient", $obj->idClient);
            $this->AddContentValue("idEmployeeCategory", $obj->idEmployeeCategory);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("idProductCategory", $obj->idProductCategory);
            $this->AddContentValue("idProduct", $obj->idProduct);
            $this->AddContentValue("idServiceCategory", $obj->idServiceCategory);
            $this->AddContentValue("idService", $obj->idService);
            $this->AddContentValue("idSetCategory", $obj->idSetCategory);
            $this->AddContentValue("idSet", $obj->idSet);
            $this->AddContentValue("idPlaceCategory", $obj->idPlaceCategory);
            $this->AddContentValue("idPlace", $obj->idPlace);
            
            $this->AddContentValue("intDayWeek1", $obj->intDayWeek1);
            $this->AddContentValue("intDayWeek2", $obj->intDayWeek2);
            $this->AddContentValue("intDayWeek3", $obj->intDayWeek3);
            $this->AddContentValue("intDayWeek4", $obj->intDayWeek4);
            $this->AddContentValue("intDayWeek5", $obj->intDayWeek5);
            $this->AddContentValue("intDayWeek6", $obj->intDayWeek6);
            $this->AddContentValue("intDayWeek7", $obj->intDayWeek7);
            
            $this->AddContentValue("intDayMonth1", $obj->intDayMonth1);
            $this->AddContentValue("intDayMonth2", $obj->intDayMonth2);
            $this->AddContentValue("intDayMonth3", $obj->intDayMonth3);
            $this->AddContentValue("intDayMonth4", $obj->intDayMonth4);
            $this->AddContentValue("intDayMonth5", $obj->intDayMonth5);
            $this->AddContentValue("intDayMonth6", $obj->intDayMonth6);
            $this->AddContentValue("intDayMonth7", $obj->intDayMonth7);
            $this->AddContentValue("intDayMonth8", $obj->intDayMonth8);
            $this->AddContentValue("intDayMonth9", $obj->intDayMonth9);
            $this->AddContentValue("intDayMonth10", $obj->intDayMonth10);
            $this->AddContentValue("intDayMonth11", $obj->intDayMonth11);
            $this->AddContentValue("intDayMonth12", $obj->intDayMonth12);
            $this->AddContentValue("intDayMonth13", $obj->intDayMonth13);
            $this->AddContentValue("intDayMonth14", $obj->intDayMonth14);
            $this->AddContentValue("intDayMonth15", $obj->intDayMonth15);
            $this->AddContentValue("intDayMonth16", $obj->intDayMonth16);
            $this->AddContentValue("intDayMonth17", $obj->intDayMonth17);
            $this->AddContentValue("intDayMonth18", $obj->intDayMonth18);
            $this->AddContentValue("intDayMonth19", $obj->intDayMonth19);
            $this->AddContentValue("intDayMonth20", $obj->intDayMonth20);
            $this->AddContentValue("intDayMonth21", $obj->intDayMonth21);
            $this->AddContentValue("intDayMonth22", $obj->intDayMonth22);
            $this->AddContentValue("intDayMonth23", $obj->intDayMonth23);
            $this->AddContentValue("intDayMonth24", $obj->intDayMonth24);
            $this->AddContentValue("intDayMonth25", $obj->intDayMonth25);
            $this->AddContentValue("intDayMonth26", $obj->intDayMonth26);
            $this->AddContentValue("intDayMonth27", $obj->intDayMonth27);
            $this->AddContentValue("intDayMonth28", $obj->intDayMonth28);
            $this->AddContentValue("intDayMonth29", $obj->intDayMonth29);
            $this->AddContentValue("intDayMonth30", $obj->intDayMonth30);
            $this->AddContentValue("intDayMonth31", $obj->intDayMonth31);

            $this->AddContentValue("intHour1", $obj->intHour1);
            $this->AddContentValue("intHour2", $obj->intHour2);
            $this->AddContentValue("intHour3", $obj->intHour3);
            $this->AddContentValue("intHour4", $obj->intHour4);
            $this->AddContentValue("intHour5", $obj->intHour5);
            $this->AddContentValue("intHour6", $obj->intHour6);
            $this->AddContentValue("intHour7", $obj->intHour7);
            $this->AddContentValue("intHour8", $obj->intHour8);
            $this->AddContentValue("intHour9", $obj->intHour9);
            $this->AddContentValue("intHour10", $obj->intHour10);
            $this->AddContentValue("intHour11", $obj->intHour11);
            $this->AddContentValue("intHour12", $obj->intHour12);
            $this->AddContentValue("intHour13", $obj->intHour13);
            $this->AddContentValue("intHour14", $obj->intHour14);
            $this->AddContentValue("intHour15", $obj->intHour15);
            $this->AddContentValue("intHour16", $obj->intHour16);
            $this->AddContentValue("intHour17", $obj->intHour17);
            $this->AddContentValue("intHour18", $obj->intHour18);
            $this->AddContentValue("intHour19", $obj->intHour19);
            $this->AddContentValue("intHour20", $obj->intHour20);
            $this->AddContentValue("intHour21", $obj->intHour21);
            $this->AddContentValue("intHour22", $obj->intHour22);
            $this->AddContentValue("intHour23", $obj->intHour23);
            $this->AddContentValue("intHour24", $obj->intHour24);
            
            $this->AddContentValue("ageStart", $obj->ageStart);
            $this->AddContentValue("ageEnd", $obj->ageEnd);
            
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
            $i = 0;
            $obj = new Criterion();
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            
            $obj->isNew = $row[$i++];
            $obj->isUse = $row[$i++];
            
            $obj->idEssential = $row[$i++];
            $obj->idClientCategory = $row[$i++];
            $obj->idClient = $row[$i++];
            $obj->idEmployeeCategory = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->idProductCategory = $row[$i++];
            $obj->idProduct = $row[$i++];
            $obj->idServiceCategory = $row[$i++];
            $obj->idService = $row[$i++];
            $obj->idSetCategory = $row[$i++];
            $obj->idSet = $row[$i++];
            $obj->idPlaceCategory = $row[$i++];
            $obj->idPlace = $row[$i++];
            
            $obj->intDayWeek1 = $row[$i++];
            $obj->intDayWeek2 = $row[$i++];
            $obj->intDayWeek3 = $row[$i++];
            $obj->intDayWeek4 = $row[$i++];
            $obj->intDayWeek5 = $row[$i++];
            $obj->intDayWeek6 = $row[$i++];
            $obj->intDayWeek7 = $row[$i++];
            
            $obj->intDayMonth1 = $row[$i++];
            $obj->intDayMonth2 = $row[$i++];
            $obj->intDayMonth3 = $row[$i++];
            $obj->intDayMonth4 = $row[$i++];
            $obj->intDayMonth5 = $row[$i++];
            $obj->intDayMonth6 = $row[$i++];
            $obj->intDayMonth7 = $row[$i++];
            $obj->intDayMonth8 = $row[$i++];
            $obj->intDayMonth9 = $row[$i++];
            $obj->intDayMonth10 = $row[$i++];
            $obj->intDayMonth11 = $row[$i++];
            $obj->intDayMonth12 = $row[$i++];
            $obj->intDayMonth13 = $row[$i++];
            $obj->intDayMonth14 = $row[$i++];
            $obj->intDayMonth15 = $row[$i++];
            $obj->intDayMonth16 = $row[$i++];
            $obj->intDayMonth17 = $row[$i++];
            $obj->intDayMonth18 = $row[$i++];
            $obj->intDayMonth19 = $row[$i++];
            $obj->intDayMonth20 = $row[$i++];
            $obj->intDayMonth21 = $row[$i++];
            $obj->intDayMonth22 = $row[$i++];
            $obj->intDayMonth23 = $row[$i++];
            $obj->intDayMonth24 = $row[$i++];
            $obj->intDayMonth25 = $row[$i++];
            $obj->intDayMonth26 = $row[$i++];
            $obj->intDayMonth27 = $row[$i++];
            $obj->intDayMonth28 = $row[$i++];
            $obj->intDayMonth29 = $row[$i++];
            $obj->intDayMonth30 = $row[$i++];
            $obj->intDayMonth31 = $row[$i++];

            $obj->intHour1 = $row[$i++];
            $obj->intHour2 = $row[$i++];
            $obj->intHour3 = $row[$i++];
            $obj->intHour4 = $row[$i++];
            $obj->intHour5 = $row[$i++];
            $obj->intHour6 = $row[$i++];
            $obj->intHour7 = $row[$i++];
            $obj->intHour8 = $row[$i++];
            $obj->intHour9 = $row[$i++];
            $obj->intHour10 = $row[$i++];
            $obj->intHour11 = $row[$i++];
            $obj->intHour12 = $row[$i++];
            $obj->intHour13 = $row[$i++];
            $obj->intHour14 = $row[$i++];
            $obj->intHour15 = $row[$i++];
            $obj->intHour16 = $row[$i++];
            $obj->intHour17 = $row[$i++];
            $obj->intHour18 = $row[$i++];
            $obj->intHour19 = $row[$i++];
            $obj->intHour20 = $row[$i++];
            $obj->intHour21 = $row[$i++];
            $obj->intHour22 = $row[$i++];
            $obj->intHour23 = $row[$i++];
            $obj->intHour24 = $row[$i++];

            $obj->ageStart = $row[$i++];
            $obj->ageEnd = $row[$i++];

            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>