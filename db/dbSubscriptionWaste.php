<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/subscriptionWaste.php');

    class DBSubscriptionWaste extends DBBase {

        public function __construct($idDB)
        {
            //$this->DropTable("SubscriptionWastes", $idDB);
            
            $this->strFields = 'idService,idEmployee,idMessage,cost,ageDay,ageChanged';
            $this->Init("SubscriptionWastes", $idDB);
        }

        public function Save($payment) {
            $this->CreateContentValue();
            $this->AddContentValue("idService", $payment->idService);
            $this->AddContentValue("idEmployee", $payment->idEmployee);
            $this->AddContentValue("idMessage", $payment->idMessage);
            $this->AddContentValue("cost", $payment->cost);
            $this->AddContentValue("ageDay", $payment->ageDay);
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
            $obj = new SubscriptionWaste();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->idService = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->idMessage = $row[$i++];
            $obj->cost = $row[$i++];
            $obj->ageDay = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function UpdateWaste($ageDay, $cost, $idService, $idEmployee) {
            $obj = new SubscriptionWaste();
            $obj->id = $this->GetIdField("idService=".$idService." AND idEmployee=".$idEmployee." AND ageDay=".$ageDay);
            $obj->idService = $idService;
            $obj->idEmployee = $idEmployee;
            $obj->cost = $cost;
            $obj->ageDay = $ageDay;
            $obj->id = $this->Save($obj);
        }
        
        public function Update($ageDay, $idService, $cost) {
            $obj = new SubscriptionWaste();
            $obj->id = $this->GetIdField("idService=".$idService." AND ageDay=".$ageDay);
            $obj->idService = $idService;
            //$obj->idEmployee = $idEmployee;
            $obj->cost = $cost;
            $obj->ageDay = $ageDay;
            $obj->id = $this->Save($obj);
        }

        
        public function GetWasteForDay($ageDay) {
            $sqlWhere = "ageDay=".$ageDay;
            $arrayWastes = $this->GetArrayRows($sqlWhere);
            $cost = 0;
            foreach ($arrayWastes as $waste) {
                $cost = $cost + $waste->cost;
            }
            return $cost;
        }

        public function GetTotalWastes() {
            $arrayWastes = $this->GetArrayRows("");
            $cost = 0;
            foreach ($arrayWastes as $waste) {
                $cost = $cost + $waste->cost;
            }
            return $cost;
        }

        public function AddWasteBySendService2222($cost, $idMessage) {
            $obj = new SubscriptionWaste();
            $obj->idService = 1001;     //  Пока какой-то такой уникальный не занятый id. Потом сделай правильно !!!
            $obj->idMessage = $idMessage;
            $obj->cost = $cost;
            $obj->ageDay = substr($this->NowLong(), 0, 8);
            $obj->ageChanged = $this->NowLong();
            $this->Save(obj);
        }

    }
?>