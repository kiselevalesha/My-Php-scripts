<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/payment.php');
    
    class DBPayment extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Payments", $idDb);
            $this->Init("Payments", $idDb);
        }

        public function New() {
            $obj = new Payment();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetPayment($id) {
            $obj = new Payment();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idTotalPayment", $obj->idTotalPayment);
            $this->AddContentValue("idEssentialPayer", $obj->idEssentialPayer);
            $this->AddContentValue("idPayer", $obj->idPayer);
            $this->AddContentValue("idEssentialReceiver", $obj->idEssentialReceiver);
            $this->AddContentValue("idReceiver", $obj->idReceiver);
            $this->AddContentValue("idTypePayment", $obj->idTypePayment);
            $this->AddContentValue("idTypeContent", $obj->idTypeContent);
            $this->AddContentValue("idItemPayment", $obj->idItemPayment);
            $this->AddContentValue("idSubItemPayment", $obj->idSubItemPayment);
            $this->AddContentValue("idMoneyBase", $obj->idMoneyBase);
            $this->AddContentValue("agePayed", $obj->agePayed);
            $this->AddContentValue("summaTips", $obj->summaTips);
            $this->AddContentValue("cost", $obj->cost);
            $this->AddContentValue("idCurrency", $obj->idCurrency);
            $this->AddContentValue("isAutoCreated", $obj->isAutoCreated);
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
            $obj = new Payment();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idTotalPayment = $row[$i++];
            $obj->idEssentialPayer = $row[$i++];
            $obj->idPayer = $row[$i++];
            $obj->idEssentialReceiver = $row[$i++];
            $obj->idReceiver = $row[$i++];
            $obj->idTypePayment = $row[$i++];
            $obj->idTypeContent = $row[$i++];
            $obj->idItemPayment = $row[$i++];
            $obj->idSubItemPayment = $row[$i++];
            $obj->idMoneyBase = $row[$i++];
            $obj->agePayed = $row[$i++];
            $obj->summaTips = $row[$i++];
            $obj->cost = $row[$i++];
            $obj->idCurrency = $row[$i++];
            $obj->isAutoCreated = $row[$i++];
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