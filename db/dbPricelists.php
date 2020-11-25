<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/pricelist.php');
    
    class DBPricelist extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Pricelists", $idDb);
            $this->Init("Pricelists", $idDb);
        }

        public function New() {
            $obj = new Pricelist();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetPricelist($id) {
            $obj = new Pricelist();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idCriterion", $obj->idCriterion);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("isAddTip", $obj->isAddTip);
            $this->AddContentValue("intTipProcents", $obj->intTipProcents);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("strJson", $obj->strJson);
            $this->AddContentValue("idEssentialAuthor", $obj->idGlobal);
            $this->AddContentValue("idAuthor", $obj->strKeyAuthor);
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
            $obj = new Pricelist();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idCriterion = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->isAddTip = $row[$i++];
            $obj->intTipProcents = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->strJson = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function GetIdDefault() {
            $sqlWhere = "isDeleted=0 AND isUse=1";
            if ($this->GetCountRows($sqlWhere) == 0)    $this->AddDefault();
            
            $base = $this->GetRowBySql($sqlWhere);
            return $base->id;
        }
        
        public function AddDefault() {
            $obj = new Pricelist();
            $obj->strName = "Первый прайслист";
            $obj->strDescription = "Автоматически созданный прайслист.";
            $obj->isNew = 0;
            return $this->Save($obj);
        }
    }

?>