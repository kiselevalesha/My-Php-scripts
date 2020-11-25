<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/shopping.php');
    
    class DBShopping extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Shoppings", $idDb);
            $this->strFields = 'isDeleted,idVendor,agePayed,summa,idCurrency,strDescription,isNew,isUse,idEssentialAuthor,idAuthor,ageChanged';
            $this->arraIndexFields = array("idVendor");
            $this->Init("Shoppings", $idDb);
        }

        public function New() {
            $obj = new Shopping();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetBill($id) {
            $obj = new Shopping();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idVendor", $obj->idVendor);
            $this->AddContentValue("agePayed", $obj->agePayed);
            $this->AddContentValue("summa", $obj->summa);
            $this->AddContentValue("idCurrency", $obj->idCurrency);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("isUse", $obj->isUse);
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
            $obj = new Shopping();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idVendor = $row[$i++];
            $obj->agePayed = $row[$i++];
            $obj->summa = $row[$i++];
            $obj->idCurrency = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->isUse = $row[$i++];
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