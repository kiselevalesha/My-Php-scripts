<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/subscriptionState.php');

    class DBSubscriptionState extends DBBase {

        public function __construct($idDB)
        {
            //$this->DropTable("SubscriptionStates", $idDB);
            
            $this->strFields = 'idService,idEmployee,idState,ageChanged';
            $this->Init("SubscriptionStates", $idDB);
        }

        public function Save($payment) {
            $this->CreateContentValue();
            $this->AddContentValue("idService", $payment->idService);
            $this->AddContentValue("idEmployee", $payment->idEmployee);
            $this->AddContentValue("idState", $payment->idState);
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
            $obj->idService = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->idState = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function UpdateState($idService, $idEmployee, $idState) {
            $obj = new SubscriptionState();
            $obj->id = $this->GetIdField("idService=".$idService." AND idEmployee=".$idEmployee);
            $obj->idService = $idService;
            $obj->idEmployee = $idEmployee;
            $obj->idState = $idState;
            $this->Save($obj);
        }
        
        public function GetState($idService, $idEmployee) {
            return $this->GetIntField("idState","idService=".$idService." AND idEmployee=".$idEmployee);
        }

    }
?>