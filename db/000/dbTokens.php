<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/token.php');

    class DBToken extends DBBase {

        public function __construct()
        {
            $this->strTableName = $this->strDbNameProject."Tokens";
            $this->idTable = EnumTables::Tokens;

            //$this->DropTable();
            $this->Init();
        }

        function GetSQLCreateTable() {
            return "CREATE TABLE ".$this->strTableName." (id INTEGER not null primary key auto_increment,
            strUidToken BLOB,
            strIdAndroidDevice BLOB,
            strCookie BLOB,
            
            strLogin BLOB,
            strPassword BLOB,
            strUidUser BLOB,
            
            strUidTalk BLOB,
            strServerTalk BLOB,
            idTalk INT,
            
            strUidDataBase BLOB,
            strServerDataBase BLOB,
            idDataBase INT,
            
            strLanguage BLOB,
            strEmail BLOB,
            strPhone BLOB,
            strIP BLOB,

            dateTimeExpired BIGINT,
            dateTimeCreated BIGINT,
            dateTimeUpdated BIGINT)";
        }

        public function Add($strIdAndroid) {
            $token = new Token();
            $token->strIdAndroid = $strIdAndroid;
            $token->id = $this->Save($token);
            return $token;
        }

        public function Save($token) {
            if (strlen($token->strIdAndroidDevice) == 0)    return 0;
            $this->CreateContentValue();
            $this->AddContentValue("strUidToken", $token->strUidToken);
            $this->AddContentValue("strIdAndroidDevice", $token->strIdAndroidDevice);
            $this->AddContentValue("strCookie", $token->strCookie);
            $this->AddContentValue("strLogin", $token->strLogin);
            $this->AddContentValue("strPassword", $token->strPassword);
            $this->AddContentValue("strUidUser", $token->strUidUser);
            
            $this->AddContentValue("strUidTalk", $token->strUidTalk);
            $this->AddContentValue("strServerTalk", $token->strServerTalk);
            $this->AddContentValue("idTalk", $token->idTalk);
            
            $this->AddContentValue("strUidDataBase", $token->strUidDataBase);
            $this->AddContentValue("strServerDataBase", $token->strServerDataBase);
            $this->AddContentValue("idDataBase", $token->idDataBase);
            
            $this->AddContentValue("strLanguage", $token->strLanguage);
            $this->AddContentValue("strEmail", $token->strEmail);
            $this->AddContentValue("strPhone", $token->strPhone);
            $this->AddContentValue("strIP", $token->strIP);
            $this->AddContentValue("dateTimeUpdated", $token->dateTimeUpdated);
            $this->AddContentValue("dateTimeExpired", $token->dateTimeExpired);

            if ($token->id == 0) {
                $this->AddContentValue("dateTimeCreated", $this->NowLong());
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($token->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($token->id == 0)   $token->id = $this->GetInsertedId();
            return $token->id;
        }
        
        
        public function DateUpdate($token) {
            if ($token->id > 0) {
                $this->CreateContentValue();
                $this->AddContentValue("dateTimeUpdated", $token->dateTimeUpdated);
                
                $query = $this->GetUpdateSQL($token->id);
                $result = $this->ExecuteQuery($query);
            }
        }
        
        
        
        public function Get($idToken) {
            $token = new Token();
            if ($idToken > 0) {
                $token->id = $idToken;
                $query = "SELECT id,strUidToken,strIdAndroidDevice,strCookie,strLogin,strPassword,strUidUser,strLanguage,strEmail,strPhone,strIP,
                    dateTimeUpdated,dateTimeExpired,strUidTalk,strServerTalk,strUidDataBase,strServerDataBase,idTalk,idDataBase  FROM  ".$this->strTableName." WHERE id=".$idToken;
                $result = $this->ExecuteQuery($query);
                
                if ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                    $token->id = $row[0];
                    $token->strUidToken = $row[1];
                    $token->strIdAndroidDevice = $row[2];
                    $token->strCookie = $row[3];
                    $token->strLogin = $row[4];
                    $token->strPassword = $row[5];
                    $token->strUidUser = $row[6];
                    $token->strLanguage = $row[7];
                    $token->strEmail = $row[8];
                    $token->strPhone = $row[9];
                    $token->strIP = $row[10];
                    $token->dateTimeUpdated = $row[11];
                    $token->dateTimeExpired = $row[12];
                    $token->strUidTalk = $row[13];
                    $token->strServerTalk = $row[14];
                    $token->strUidDataBase = $row[15];
                    $token->strServerDataBase = $row[16];
                    $token->idTalk = $row[17];
                    $token->idDataBase = $row[18];
                }
            }
            return $token;
        }
        
        public function GetArrayTokens($sqlWhere) {
            $arrayTokens = array();
            
            $query = "SELECT id,strUidToken,strIdAndroidDevice,strCookie,strLogin,strPassword,strUidUser,strLanguage,strEmail,strPhone,strIP,
            dateTimeUpdated,dateTimeExpired,strUidTalk,strServerTalk,strUidDataBase,strServerDataBase,dateTimeCreated,idTalk,idDataBase  FROM  ".$this->strTableName;
            if (strlen($sqlWhere) > 0)  $query .= " WHERE ".$sqlWhere;
            $query .= " ORDER BY dateTimeUpdated DESC";
            $result = $this->ExecuteQuery($query);
            
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                
                $token = new Token();
                $token->id = $row[0];
                $token->strUidToken = $row[1];
                $token->strIdAndroidDevice = $row[2];
                $token->strCookie = $row[3];
                $token->strLogin = $row[4];
                $token->strPassword = $row[5];
                $token->strUidUser = $row[6];
                $token->strLanguage = $row[7];
                $token->strEmail = $row[8];
                $token->strPhone = $row[9];
                $token->strIP = $row[10];
                $token->dateTimeUpdated = $row[11];
                $token->dateTimeExpired = $row[12];
                $token->strUidTalk = $row[13];
                $token->strServerTalk = $row[14];
                $token->strUidDataBase = $row[15];
                $token->strServerDataBase = $row[16];
                $token->dateTimeCreated = $row[17];
                $token->idTalk = $row[18];
                $token->idDataBase = $row[19];
                
                array_push($arrayTokens, $token);
            }
            return $arrayTokens;
        }

        public function GetIdByAndroidDevice($strAndroidDevice) {
            $idToken = 0;
            if (strlen($strAndroidDevice) > 0) {
                $query = "SELECT id FROM  ".$this->strTableName." WHERE strIdAndroidDevice LIKE '$strAndroidDevice'";
                $result = $this->ExecuteQuery($query);
                if ($row = mysql_fetch_array($result, MYSQL_NUM))   $idToken = $row[0];
            }
            return $idToken;
        }

    }
?>