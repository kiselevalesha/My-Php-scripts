<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/base.php');
    include_once('../php-scripts/models/yandexMoney.php');
    
    class DBYandexMoney extends DBBase {

        public function __construct()
        {
            //$this->DropTable("YandexMoney", "");

            $this->strFields = 'strCodePayment,longCodePayment,strDescription,strUniqKey,ageRequest,agePayed,idDB,idEmployee,summaRequest,summaPayed,isPayed';
            $this->arraIndexFields = array("longCodePayment", "idDB");
            $this->Init("YandexMoney", "");
        }

        public function New($strToken, $idDB, $idEmployee, $summa) {
            $obj = new YandexMoney();
            $obj->idDB = $idDB;
            $obj->idEmployee = $idEmployee;
            $obj->strUniqKey = uniqid();
            $obj->strToken = $strToken;
            $obj->summaRequest = $summa;
            $obj->ageRequest = $this->NowLong();
            $obj->id = $this->Save($obj);
            $this->UpdateField("strDescription", "Заказ №".$obj->id, "id=".$obj->id);
            return $obj;
        }

        public function SaveCode($strCode, $id) {
            $this->UpdateField("strCodePayment", $strCode, "id=".$id);
            //$strNumbers = GetNumbers($strCode);
            return $obj;
        }

        public function SetPayed($id, $summa) {
            $this->UpdateField("agePayed", $this->NowLong(), "id=".$id);
            $this->UpdateField("summaPayed", $summa, "id=".$id);
            $this->UpdateField("isPayed", 1, "id=".$id);
            return $obj;
        }
        
        

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("strCodePayment", $obj->strCodePayment);
            $this->AddContentValue("longCodePayment", $obj->longCodePayment);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strUniqKey", $obj->strUniqKey);
            $this->AddContentValue("ageRequest", $obj->ageRequest);
            $this->AddContentValue("agePayed", $obj->agePayed);
            $this->AddContentValue("idDB", $obj->idDB);
            $this->AddContentValue("idEmployee", $obj->idEmployee);
            $this->AddContentValue("summaRequest", $obj->summaRequest);
            $this->AddContentValue("summaPayed", $obj->summaPayed);
            $this->AddContentValue("isPayed", $obj->isPayed);

            if ($obj->id == 0) {
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
            $obj = new YandexMoney();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->strCodePayment = $row[$i++];
            $obj->longCodePayment = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strUniqKey = $row[$i++];
            $obj->ageRequest = $row[$i++];
            $obj->ageFinished = $row[$i++];
            $obj->idDB = $row[$i++];
            $obj->idEmployee = $row[$i++];
            $obj->summaRequest = $row[$i++];
            $obj->summaPayed = $row[$i++];
            $obj->isPayed = $row[$i++];
            return $obj;
        }

    }
?>