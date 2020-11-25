<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/bill.php');
    
    class DBBill extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Bills", $idDb);
            $this->Init("Bills", $idDb);
        }

        public function New() {
            $obj = new Bill();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetBill($id) {
            $obj = new Bill();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idTotalPayment", $obj->idTotalPayment);
            $this->AddContentValue("intBillNumber", $obj->intBillNumber);
            $this->AddContentValue("idAppointment", $obj->idAppointment);
            $this->AddContentValue("idEssentialContent", $obj->idEssentialContent);
            $this->AddContentValue("idMaster", $obj->idMaster);
            $this->AddContentValue("idAdministrator", $obj->idAdministrator);
            $this->AddContentValue("ageBilled", $obj->ageBilled);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("idTypeBill", $obj->idTypeBill);
            $this->AddContentValue("summaTotal", $obj->summaTotal);
            $this->AddContentValue("idCurrency", $obj->idCurrency);
            $this->AddContentValue("idTax", $obj->idTax);
            $this->AddContentValue("isAutoCalc", $obj->isAutoCalc);
            $this->AddContentValue("isSaved", $obj->isSaved);
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
            $obj = new Bill();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idTotalPayment = $row[$i++];
            $obj->intBillNumber = $row[$i++];
            $obj->idAppointment = $row[$i++];
            $obj->idEssentialContent = $row[$i++];
            $obj->idMaster = $row[$i++];
            $obj->idAdministrator = $row[$i++];
            $obj->ageBilled = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->idTypeBill = $row[$i++];
            $obj->summaTotal = $row[$i++];
            $obj->idCurrency = $row[$i++];
            $obj->idTax = $row[$i++];
            $obj->isAutoCalc = $row[$i++];
            $obj->isSaved = $row[$i++];
            $obj->isNew = $row[$i++];
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