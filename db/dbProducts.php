<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/product.php');
    
    class DBProduct extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Products", $idDb);
            $this->Init("Products", $idDb);
        }

        public function New() {
            $obj = new Product();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetProduct($id) {
            $obj = new Product();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function GetId($obj) {
            if (! empty($obj->strName)) {
                //$sql = " LOWER(strName) LIKE '".mb_strtolower($obj->strName)."' AND isDeleted=0";
                $sql = " strName LIKE '".$obj->strName."' AND isDeleted=0";
                return $this->GetIdField($sql);
            }
            else
                return 0;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strNameOnline", $obj->strNameOnline);
            $this->AddContentValue("strNameCheque", $obj->strNameCheque);
            $this->AddContentValue("strSynonyms", $obj->strSynonyms);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strArticul", $obj->strArticul);
            $this->AddContentValue("strBarCode", $obj->strBarCode);
            $this->AddContentValue("idCategory", $obj->idCategory);
            $this->AddContentValue("intUsePeriod", $obj->intUsePeriod);
            $this->AddContentValue("isAutoCalculation", $obj->isAutoCalculation);
            $this->AddContentValue("idNotificationRule", $obj->idNotificationRule);
            $this->AddContentValue("idTax", $obj->idTax);
            $this->AddContentValue("idUnitProduct", $obj->idUnitProduct);
            $this->AddContentValue("idUnitContent", $obj->idUnitContent);
            $this->AddContentValue("intQuantityBrutto", $obj->intQuantityBrutto);
            $this->AddContentValue("intQuantityNetto", $obj->intQuantityNetto);
            $this->AddContentValue("idItemWizard", $obj->idItemWizard);
            $this->AddContentValue("isForWoman", $obj->isForWoman);
            $this->AddContentValue("isForMan", $obj->isForMan);
            $this->AddContentValue("isForChildren", $obj->isForChildren);
            $this->AddContentValue("isForSale", $obj->isForSale);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isShowOnline", $obj->isShowOnline);
            $this->AddContentValue("isNew", $obj->isNew);
            //$this->AddContentValue("idMainPhoto", $obj->idMainPhoto);
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
            if ($obj->id == 0) {
                //$base = $this->GetRowBySql(" LOWER(strName) LIKE '".mb_strtolower($obj->strName)."'");
                //if (!empty($base->id))  $obj->id = $base->id;
                $obj->id = $this->GetId($obj);
            }
            return $this->Save($obj);
        }

        public function GetRow($row) {
            $obj = new Product();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strNameOnline = $row[$i++];
            $obj->strNameCheque = $row[$i++];
            $obj->strSynonyms = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strArticul = $row[$i++];
            $obj->strBarCode = $row[$i++];
            $obj->idCategory = $row[$i++];
            $obj->intUsePeriod = $row[$i++];
            $obj->isAutoCalculation = $row[$i++];
            $obj->idNotificationRule = $row[$i++];
            $obj->idTax = $row[$i++];
            $obj->idUnitProduct = $row[$i++];
            $obj->idUnitContent = $row[$i++];
            $obj->intQuantityBrutto = $row[$i++];
            $obj->intQuantityNetto = $row[$i++];
            $obj->idItemWizard = $row[$i++];
            $obj->isForWoman = $row[$i++];
            $obj->isForMan = $row[$i++];
            $obj->isForChildren = $row[$i++];
            $obj->isForSale = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isShowOnline = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->idMainPhoto = $row[$i++];
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