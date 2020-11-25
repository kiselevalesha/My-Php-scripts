<?
    require_once('../php-scripts/db/dbBase.php');
    require_once('../php-scripts/models/order.php');

    class DBOrder extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Orders", $idDb);
            $this->strFields = "strName,strDescription,strNomer,strType,idCategory,strBody,ageDate,isNew,isUse,isDeleted";
            $this->Init("Orders", $idDb);
        }

        public function New() {
            $obj = new Order();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetOrder($id) {
            $obj = new Order();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($order) {
            $this->CreateContentValue();
            $this->AddContentValue("strName", $order->strName);
            $this->AddContentValue("strDescription", $order->strDescription);
            $this->AddContentValue("strNomer", $order->strNomer);
            $this->AddContentValue("strType", $order->strType);
            $this->AddContentValue("idCategory", $order->idCategory);
            $this->AddContentValue("strBody", $order->strBody);
            $this->AddContentValue("ageDate", $order->ageDate);
            $this->AddContentValue("isNew", $order->isNew);
            $this->AddContentValue("isUse", $order->isUse);

            if ($order->id == 0) {
                $this->AddContentValue("isDeleted", $order->isDeleted);
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($order->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($order->id == 0)   $order->id = $this->GetInsertedId();
            return $order->id;
        }

        public function GetRow($row) {
            $order = new Order();
            $i = 0;
            $order->id = $row[$i++];
            $order->strName = $row[$i++];
            $order->strDescription = $row[$i++];
            $order->strNomer = $row[$i++];
            $order->strType = $row[$i++];
            $order->idCategory = $row[$i++];
            $order->strBody = $row[$i++];
            $order->ageDate = $row[$i++];
            $order->isNew = $row[$i++];
            $order->isUse = $row[$i++];
            $order->isDeleted = $row[$i++];
            return $order;
        }
        
        public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                .'"name":"'.$obj->strName.'",'
                .'"description":"'.$obj->strDescription.'",'
                .'"changed":'.$obj->ageChanged;
        }
    }
?>