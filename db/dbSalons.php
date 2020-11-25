<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/salon.php');
    require_once '../php-scripts/utils/getUrlFile.php';
    
    class DBSalon extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Salons", $idDb);
            $this->Init("Salons", $idDb);
        }

        public function New($strName = "") {
            $obj = new Salon();
            if (!empty($strName))   $obj->strName = $strName;
            $obj->id = $this->Save($obj);
            return $obj;
        }
        
        public function GetSalon($id) {
            $obj = new Salon();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("strFirebase", $obj->strFirebase);
            $obj->intCodeFirebase = $this->GetSimpleCode($obj->strFirebase);
            $this->AddContentValue("intCodeFirebase", $obj->intCodeFirebase);
            $this->AddContentValue("idCategory", $obj->idCategory);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strAlias", $obj->strAlias);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("intINN", $obj->intINN);
            $this->AddContentValue("intKPP", $obj->intKPP);
            $this->AddContentValue("idTypeLegacy", $obj->idTypeLegacy);
            $this->AddContentValue("idMainPhoto", $obj->idMainPhoto);
            $this->AddContentValue("isShowOnline", $obj->isShowOnline);
            $this->AddContentValue("isUse", $obj->isUse);
            $this->AddContentValue("isNew", $obj->isNew);
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

        public function GetRow($row) {
            $obj = new Salon();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->strFirebase = $row[$i++];
            $obj->intCodeFirebase = $row[$i++];
            $obj->idCategory = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strAlias = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->intINN = $row[$i++];
            $obj->intKPP = $row[$i++];
            $obj->idTypeLegacy = $row[$i++];
            $obj->idMainPhoto = $row[$i++];
            $obj->isShowOnline = $row[$i++];
            $obj->isUse = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                .'"name":"'.$obj->strName.'",'
                .'"description":"'.$obj->strDescription.'",'
                .'"changed":'.$obj->ageChanged;
        }
        
        public function GetDefault() {
            return $this->Get($this->GetIdDefault());
        }
        public function GetIdDefault() {
            $base = $this->GetRowBySql("isUse=1 AND isDeleted=0");
            if (empty($base->id)) {
                $base = new Salon();
                $base->strName = "Собственные записи";
                $base->strDescription = "Создано сервисом автоматически.";
                $base->strFirebase = $this->GetUidSalonFromFirebase();
                $base->isNew = 0;
                $base->id = $this->Save($base);
            }
            return $base->id;
        }

        //  Получить в Firebase uid салона. У него будет свойство last - дата последнего обновления
        function GetUidSalonFromFirebase() {
            
            $host = 1;

            $response = getUrlFile("https://us-central1-onlinezapis-b03a2.cloudfunctions.net/AddSalon?host=".$host, null);
            $jsonFirebase = json_decode($response, false, 32);
            
            if (isSet($jsonFirebase->status->id))
                if ($jsonFirebase->status->id == 200)
                    if (isSet($jsonFirebase->data->uid))  return $jsonFirebase->data->uid;
                    
            return "";
        }
    }

?>