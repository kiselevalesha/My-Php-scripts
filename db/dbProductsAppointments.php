<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/productsAppointment.php');

    abstract class EnumProductRelationTables {
        const NameTableOrder = 'ProductsOrder';
        const NameTableVisit = 'ProductsVisit';
    }
    
    class DBProductsAppointment extends DBBase {

        public function __construct($idDb, $strParentTableName)
        {
            //$this->DropTable($strParentTableName, $idDb);    //"ProductsAppointments"
            //$this->strFields ='isDelete,idOwner,intQuantity,intMinutesDuration,idEssential,idProduct,cost,summaTotal,summaTax,summaTip,isCheckedForPayment,dateTimeUpdated,isManualEdited,isChecked,idGlobal,strKeyAuthor,dateTimeGlobalChanged';
            $this->arraIndexFields = array("idOwner", "idProduct");
            $this->Init($strParentTableName, $idDb);
        }

        public function New() {
            $obj = new ProductAppointment();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("intQuantity", $obj->intQuantity);
            $this->AddContentValue("intMinutesDuration", $obj->intMinutesDuration);
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idProduct", $obj->idProduct);
            $this->AddContentValue("cost", $obj->cost);
            $this->AddContentValue("summaTotal", $obj->summaTotal);
            $this->AddContentValue("summaTax", $obj->summaTax);
            $this->AddContentValue("summaTip", $obj->summaTip);
            $this->AddContentValue("isCheckedForPayment", $obj->isCheckedForPayment);
            $this->AddContentValue("dateTimeUpdated", $this->NowLong());
            $this->AddContentValue("isManualEdited", $obj->isManualEdited);
            $this->AddContentValue("isChecked", $obj->isChecked);
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
            $id = $this->GetId($obj);
            //echo " SaveUpdate id=".$id;
            if ($id > 0)  $obj->id = $id;
            //echo "  id=".$id;
            return $this->Save($obj);
        }
        
        public function GetId($obj) {
            $base = $this->GetRowBySql("idOwner=".$obj->idOwner." AND idProduct=".$obj->idProduct." AND idEssential=".$obj->idEssential);
            return $base->id;
        }

        public function GetRow($row) {
            $obj = new ProductAppointment();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->intQuantity = $row[$i++];
            $obj->intMinutesDuration = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idProduct = $row[$i++];
            $obj->cost = $row[$i++];
            $obj->summaTotal = $row[$i++];
            $obj->summaTax = $row[$i++];
            $obj->summaTip = $row[$i++];
            $obj->isCheckedForPayment = $row[$i++];
            $obj->dateTimeUpdated = $row[$i++];
            $obj->isManualEdited = $row[$i++];
            $obj->isChecked = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
    }

?>