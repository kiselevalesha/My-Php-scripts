<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/user.php');
    
    class DBUser extends DBBase {
        

        public function __construct()  { }


        public function SaveImage($idUser, $idPhoto, $strUrlPhoto) {
            $this->CreateContentValue();
            $this->AddContentValue("idPhoto", $idPhoto);
            $this->AddContentValue("strUrlPhoto", $strUrlPhoto);
            $this->AddContentValue("dateTimeUpdated", $this->Now());

            if ($idUser == 0) {
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($idUser);
            }

            $result = $this->ExecuteQuery($query);
            if ($idUser == 0)   $idUser = $this->GetInsertedId();
            return $idUser;
        }
        
        public function GetStrFIO($idUser) {
            $strFIO = "";
            $query = "SELECT  strName, strSurname, strPatronymic  FROM  ".$this->strTableName." WHERE id=".$idUser;
            $result = $this->ExecuteQuery($query);
            if ($row = mysql_fetch_array($result, MYSQL_NUM))   $strFIO = $row[1]." ".$row[0]." ".$row[2];
            return $strFIO;
        }
        
        public function GetIdByUID($strUid) {
            $idMaster = 0;
            if (strlen($strUid) > 0) {
                $query = "SELECT id FROM  ".$this->strTableName." WHERE strUid LIKE '".$strUid."'";
                $result = $this->ExecuteQuery($query);
    
                if ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                    $idMaster = $row[0];
                }
            }
            return $idMaster;
        }
        
    }

?>