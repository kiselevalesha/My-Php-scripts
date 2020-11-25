<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/image.php');
    
    class DBImage extends DBBase {
        
        public function __construct($idDb)
        {
            //$this->DropTable("Images", $idDb);
            $this->Init("Images", $idDb);
        }

        public function New() {
            $obj = new Image();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetImage($id) {
            $obj = new Image();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function GetId($obj) {
            $sql = "";
            if (! empty($obj->strUrl))
               $sql .= "strUrl='".$obj->strUrl."' AND ";
               
            if (! empty($obj->idSite))
               $sql .= "idSite=".$obj->idSite." AND ";

            $sql .= " isDeleted=0";
            return $this->GetIdField($sql);
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idSite", $obj->idSite);
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("strName", $obj->strName);
            $this->AddContentValue("strDescription", $obj->strDescription);
            $this->AddContentValue("strDescriptionOnline", $obj->strDescriptionOnline);
            $this->AddContentValue("strUrl", $obj->strUrl);
            $this->AddContentValue("intFileSize", $obj->intFileSize);
            $this->AddContentValue("isPublish", $obj->isPublish);
            $this->AddContentValue("isShowOnline", $obj->isShowOnline);
            $this->AddContentValue("isMainInSequence", $obj->isMainInSequence);
            $this->AddContentValue("isUseInPortfolio", $obj->isUseInPortfolio);
            $this->AddContentValue("isNew", $obj->isNew);
            $this->AddContentValue("idEssentialAuthor", $obj->idEssentialAuthor);
            $this->AddContentValue("idAuthor", $obj->idAuthor);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id == 0) {
                $this->AddContentValue("ageCreated", $this->NowLong());
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
            $obj = new Image();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idSite = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->strName = $row[$i++];
            $obj->strDescription = $row[$i++];
            $obj->strDescriptionOnline = $row[$i++];
            $obj->strUrl = $row[$i++];
            $obj->intFileSize = $row[$i++];
            $obj->isPublish = $row[$i++];
            $obj->isShowOnline = $row[$i++];
            $obj->isMainInSequence = $row[$i++];
            $obj->isUseInPortfolio = $row[$i++];
            $obj->isNew = $row[$i++];
            $obj->ageCreated = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        public function GetJsonArrayImages($idOwner, $idEssential, $isUseInPortfolio) {
            $sqlWhere = "isDeleted=0";
            if ($idOwner > 0)   $sqlWhere .= " AND idOwner=".$idOwner;
            if ($idEssential > 0)   $sqlWhere .= " AND idEssential=".$idEssential;
            if ($isUseInPortfolio > 0)   $sqlWhere .= " AND isUseInPortfolio=".$isUseInPortfolio;
            return $this->GetJsonOrderRows($sqlWhere, "ageCreated DESC");
        }
        public function GetJsonPhotos($idOwner, $idEssential) {
            return $this->GetJsonArrayImages($idOwner, $idEssential, 0);
        }
        public function GetJsonPortfolio($idOwner, $idEssential) {
            return $this->GetJsonArrayImages($idOwner, $idEssential, 1);
        }

        public function AddNewImage($idEssential, $idOwner, $strFileName, $isMainInSequence, $isUseInPortfolio=0) {
            return $this->AddNewImageFromSite($idEssential, $idOwner, $strFileName, $isMainInSequence, EnumIdSites::SITE_TALON24_RU, $isUseInPortfolio);
        }

        public function AddNewImageFromSite($idEssential, $idOwner, $strFileName, $isMainInSequence, $idSite, $isUseInPortfolio=0) {
            $obj = new Image();
            $obj->idEssential = $idEssential;
            $obj->idOwner = $idOwner;
            $obj->strUrl = $strFileName;
            $obj->isMainInSequence = $isMainInSequence;
            $obj->idSite = $idSite;
            $obj->isUseInPortfolio = $isUseInPortfolio;

            //  Если $isMainInSequence == 1, то нужно у возможных других фото в сиквенции установить = 0
            if ($isMainInSequence > 0)
                $this->UpdateField("isMainInSequence", 0, "idOwner=".$idOwner." AND idEssential=".$idEssential);
                
            $obj->isNew = 0;
            $obj->id = $this->Save($obj);
            return $obj;
        }
    }

?>