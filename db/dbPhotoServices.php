<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/ownerService.php');

    class DBPhotoService extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("PhotoServices", $idDb);
            $this->strFields = 'isDeleted,idPhoto,idService,isChecked,idEssentialAuthor,idAuthor,ageChanged';
            $this->Init("PhotoServices", $idDb);
        }

        public function GetChecked($idPhoto, $idService) {
            return $this->GetIntField("isChecked", "idService=".$idService." AND idPhoto=".$idPhoto." AND isDeleted=0");
        }

        public function Update($idPhoto, $idService) {
            $obj = new OwnerService();
            $obj->idOwner = $idPhoto;
            $obj->idService = $idService;
            $obj->isChecked = 1;
            $obj->id = $this->SaveUpdate($obj);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idPhoto", $obj->idOwner);
            $this->AddContentValue("idService", $obj->idService);
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

        public function GetRow($row) {
            $obj = new OwnerService();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->idService = $row[$i++];
            $obj->isChecked = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

        public function GetId($obj) {
            return $this->GetIdField("idPhoto=".$obj->idOwner." AND idService=".$obj->idService." AND isDeleted=0");
        }

        public function SaveUpdate($obj) {
            $obj->id = $this->GetId($obj);
            if ($obj->isChecked > 0) {
                if ($obj->id > 0)   $this->UpdateField("isChecked", 1, "id=".$obj->id); 
                else                $this->Save($obj);
            }
            else {
                if ($obj->id > 0)   $this->UpdateField("isChecked", 0, "id=".$obj->id); 
            }
        }
        
    }

?>