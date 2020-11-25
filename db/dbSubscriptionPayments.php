<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/subscriptionPayment.php');

    class DBSubscriptionPayment extends DBBase {

        public function __construct($idDB)
        {
            //$this->DropTable("SubscriptionPayments", $idDB);
            
            $this->strFields = 'isDeleted,agePayment,idTypePayment,idPayment,summaPayment,summaBonus,strDescription,ageChanged';
            $this->Init("SubscriptionPayments", $idDB);
        }

        public function AddGift() {
            $obj = new SubscriptionPayment();
            $obj->agePayment = $this->NowLong();
            $obj->idTypePayment = EnumTypePayments::TypeStartGift;
            $obj->summaPayment = 9900;
            $obj->strDescription = 'Подарок от сервиса.';
            $this->Save($obj);
            return $obj->summaPayment;
        }

        public function UpdateYandexPayment($idPayment, $summaPayment, $strDescription) {
            $id = $this->GetIdField("idPayment=".$idPayment." AND isDeleted=0");
            if ($id > 0)
                $obj = $this->Get($id);
            else
                $obj = new SubscriptionPayment();
            $obj->agePayment = $this->NowLong();
            $obj->idPayment = $idPayment;
            $obj->idTypePayment = EnumTypePayments::TypeYandexMoney;
            $obj->summaPayment = $summaPayment;
            $obj->summaBonus = round($summaPayment / 10);
            $obj->strDescription = $strDescription;
            $this->Save($obj) ;
        }
        
        public function Save($payment) {
            $this->CreateContentValue();
            $this->AddContentValue("agePayment", $payment->agePayment);
            $this->AddContentValue("idTypePayment", $payment->idTypePayment);
            $this->AddContentValue("idPayment", $payment->idPayment);
            $this->AddContentValue("summaPayment", $payment->summaPayment);
            $this->AddContentValue("summaBonus", $payment->summaBonus);
            $this->AddContentValue("strDescription", $payment->strDescription);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($payment->id == 0) {
                $this->AddContentValue("isDeleted", $payment->isDeleted);
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
            $obj = new SubscriptionPayment();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->agePayment = $row[$i++];
            $obj->idTypePayment = $row[$i++];
            $obj->idPayment = $row[$i++];
            $obj->summaPayment = $row[$i++];
            $obj->summaBonus = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function GetTotalRealPayments() {
            $sqlWhere = "NOT idTypePayment=".EnumTypePayments::TypeStartGift." AND isDeleted=0";
            $arrayPayments = $this->GetArrayRows($sqlWhere);
            $cost = 0;
            foreach ($arrayPayments as $payment) {
                $cost = $cost + $payment->summaPayment + $payment->summaBonus;
            }
            return $cost;
        }

    }
?>