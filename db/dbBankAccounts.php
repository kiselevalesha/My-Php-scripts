<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/bankAccount.php');
    
    class DBBankAccount extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("BankAccounts", $idDb);
            $this->strFields = 'isDeleted,idEssential,idOwner,strName,strBIK,strBankName,strRasAccount,strKorAccount,isDefault,strToken,ageChanged';
            $this->Init("BankAccounts", $idDb);
        }

        public function Save($obj, $strToken) {
            $this->CreateContentValue();
            $this->AddContentValue("idEssential", $obj->idEssential);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("strBIK", $obj->strBIK);
            $this->AddContentValue("strBankName", $obj->strBankName);
            $this->AddContentValue("strRasAccount", $obj->strRasAccount);
            $this->AddContentValue("strKorAccount", $obj->strKorAccount);
            $this->AddContentValue("isDefault", $obj->isDefault);

            $this->AddContentValue("strToken", $strToken);
            $this->AddContentValue("ageChanged", $this->NowLong());

            if ($obj->id < 1) {
                $this->AddContentValue("isDeleted", $obj->isDeleted);
                $query = $this->GetInsertSQL();
            }
            else {
                $query = $this->GetUpdateSQL($obj->id);
            }

            $result = $this->ExecuteQuery($query);
            if ($obj->id < 1)   $obj->id = $this->GetInsertedId();
            return $obj->id;
        }

        public function GetRow($row) {
            $obj = new BankAccount();
            $i = 0;
            $obj->id = $row[$i++];
            
            $obj->isDeleted = $row[$i++];
            $obj->idEssential = $row[$i++];
            $obj->idOwner = $row[$i++];
            
            $obj->strBIK = $row[$i++];
            $obj->strBankName = $row[$i++];
            $obj->strRasAccount = $row[$i++];
            $obj->strKorAccount = $row[$i++];
            $obj->isDefault = $row[$i++];

            $obj->strToken = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }

    }

?>