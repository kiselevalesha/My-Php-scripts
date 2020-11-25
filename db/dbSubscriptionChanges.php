<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/subscriptionState.php');

    class DBSubscriptionChange extends DBBase {

        public function __construct($idDB)
        {
            //$this->DropTable("SubscriptionChanges", $idDB);
            
            $this->strFields = 'ageDay,idService,idEmployee,idState,idEssentialAuthor,idAuthor,ageChanged';
            $this->Init("SubscriptionChanges", $idDB);
        }

        public function Save($payment) {
            $this->CreateContentValue();
            $this->AddContentValue("ageDay", $payment->ageDay);
            $this->AddContentValue("idService", $payment->idService);
            $this->AddContentValue("idEmployee", $payment->idEmployee);
            $this->AddContentValue("idState", $payment->idState);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($payment->id == 0) {
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($payment->id);
            }
            $result = $this->ExecuteQuery($query);
            
            if ($payment->id == 0)   $payment->id = $this->GetInsertedId();
            return $payment->id;
        }

        public function GetRow($row) {
            $obj = new SubscriptionState();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->ageDay = $row[$i++];
            $obj->idService = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->idState = $row[$i++];
            $obj->dateTimeGlobalChanged = $row[$i++];
            return $obj;
        }
        
        public function AddChange($idService, $idEmployee, $idState) {
            $obj = new SubscriptionState();
            $obj->ageDay = date("Y")*10000 + date("n")*100 + date("d");
            $obj->idService = $idService;
            $obj->idEmployee = $idEmployee;
            $obj->idState = $idState;
            $obj->id = $this->Save($obj);
        }

    }
?>