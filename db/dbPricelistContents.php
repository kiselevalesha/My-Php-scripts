<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/pricelistContent.php');
    
    class DBPricelistContent extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("PricelistContent", $idDb);
            $this->arraIndexFields = array("idPricelist", "idProduct");
            $this->Init("PricelistContent", $idDb);
        }

        public function New() {
            $obj = new PricelistContent();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetContent($id) {
            $obj = new PricelistContent();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function GetId($idProduct, $idPricelist) {
            return $this->GetIdField("idPricelist=".$idPricelist." AND idProduct=".$idProduct." AND isDeleted=0");
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idPricelist", $obj->idPricelist);
            $this->AddContentValue("idPricelistSection", $obj->idPricelistSection);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idProduct", $obj->idProduct);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isCostPerTime", $obj->isCostPerTime);
            $this->AddContentValue("isAbonement", $obj->isAbonement);
            $this->AddContentValue("intQuantity", $obj->intQuantity);
            $this->AddContentValue("idWhat", $obj->idWhat);
            $this->AddContentValue("intDurationMinutes", $obj->intDurationMinutes);
            $this->AddContentValue("costForSale", $obj->costForSale);
            $this->AddContentValue("costForService", $obj->costForService);
            $this->AddContentValue("intSellerProcents", $obj->intSellerProcents);
            $this->AddContentValue("summaSellerFixMoney", $obj->summaSellerFixMoney);
            $this->AddContentValue("intMasterProcents", $obj->intMasterProcents);
            $this->AddContentValue("summaMasterFixMoney", $obj->summaMasterFixMoney);
            $this->AddContentValue("isCalcProductPrice", $obj->isCalcProductPrice);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("idTax", $obj->idTax);
            $this->AddContentValue("idCurrency", $obj->idCurrency);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
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

        public function SaveUpdate($obj) {
            $base = $this->GetRowBySql("idPricelist=".$obj->idPricelist." AND idProduct=".$obj->idProduct." AND idEssential=".$obj->idEssential." AND isDeleted=0");
            if ($base->id > 0)  $obj->id = $base->id;
            return $this->Save($obj);
        }

        public function GetRow($row) {
            $obj = new PricelistContent();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idPricelist = $row[$i++];
            $obj->idPricelistSection = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idProduct = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isCostPerTime = $row[$i++];
            $obj->isAbonement = $row[$i++];
            $obj->intQuantity = $row[$i++];
            $obj->idWhat = $row[$i++];
            $obj->intDurationMinutes = $row[$i++];
            $obj->costForSale = $row[$i++];
            $obj->costForService = $row[$i++];
            $obj->intSellerProcents = $row[$i++];
            $obj->summaSellerFixMoney = $row[$i++];
            $obj->intMasterProcents = $row[$i++];
            $obj->summaMasterFixMoney = $row[$i++];
            $obj->isCalcProductPrice = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->idTax = $row[$i++];
            $obj->idCurrency = $row[$i++];
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