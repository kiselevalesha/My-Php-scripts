<?
    include_once('../php-scripts/db/dbBase.php');
    include_once('../php-scripts/models/contact.php');
    require_once('../php-scripts/models/essential.php');
    
    class DBContact extends DBBase {

        public function __construct($idDb)
        {
            //$this->DropTable("Contacts", $idDb);
            $this->Init("Contacts", $idDb);
        }

        public function New() {
            $obj = new Contact();
            $obj->id = $this->Save($obj);
            return $obj;
        }

        public function GetContact($id) {
            $obj = new Contact();
            if ($id > 0)    $obj = $this->Get($id);
            return $obj;
        }

        public function Save($obj) {
            $this->CreateContentValue();
            $this->AddContentValue("idOwnerEssential", $obj->idOwnerEssential);
            $this->AddContentValue("idOwner", $obj->idOwner);
            $this->AddContentValue("idType", $obj->idType);
            $this->AddContentValue("isAllow", $obj->isAllow);
            $this->AddContentValue("strText", $obj->strText);
            $this->AddContentValue("intPhonePrefix", $obj->intPhonePrefix);
            $this->AddContentValue("intCodeText", $this->GetSimpleCode($obj->strText));
            $this->AddContentValue("strPassword", $obj->strPassword);
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
            $obj = new Contact();
            $i = 0;
            $obj->id = $row[$i++];
            $obj->isDeleted = $row[$i++];
            $obj->idOwnerEssential = $row[$i++];
            $obj->idOwner = $row[$i++];
            $obj->idType = $row[$i++];
            $obj->isAllow = $row[$i++];
            $obj->strText = $row[$i++];
            $obj->intPhonePrefix = $row[$i++];
            $obj->intCodeText = $row[$i++];
            $obj->strPassword = $row[$i++];
            $obj->idEssentialAuthor = $row[$i++];
            $obj->idAuthor = $row[$i++];
            $obj->ageChanged = $row[$i++];
            return $obj;
        }
        
        /*public function MakeJson($obj) {
            return '"id":"'.$obj->id.'",'
                //.'"name":"'.$obj->strName.'",'
                //.'"description":"'.$obj->strDescription.'",'
                .'"changed":'.$obj->ageChanged;
        }*/
        


        public function SaveContacts($contacts, $idOwner, $idTypeUser) {
            foreach($contacts as $contact) {
                $this->Save($contact);
            }
        }





        public function GetVKClient($idUser) {
            return $this->GetVKContact($idUser, EnumEssential::CLIENTS);
        }
        public function GetVKEmployee($idUser) {
            return $this->GetVKContact($idUser, EnumEssential::EMPLOYEE);
        }
        public function GetVKContact($idUser, $idTypeUser) {
            return $this->GetContactUser($idUser, $idTypeUser, EnumTypeContacts::TypeVK);
        }

        public function GetPhoneClient($idUser) {
            return $this->GetPhoneContact($idUser, EnumEssential::CLIENTS);
        }
        public function GetPhoneEmployee($idUser) {
            return $this->GetPhoneContact($idUser, EnumEssential::EMPLOYEE);
        }
        public function GetPhoneContact($idUser, $idTypeUser) {
            $contact = $this->GetRowBySql("idOwner=".$idUser." AND idOwnerEssential=".$idTypeUser." AND idType=".EnumTypeContacts::TypePhone." AND isDeleted=0");
            if ($contact instanceof Contact)
                return $contact->GetPhoneNumber();
            return "";
        }

        public function GetEmailClient($idUser) {
            return $this->GetEmailContact($idUser, EnumEssential::CLIENTS);
        }
        public function GetEmailEmployee($idUser) {
            return $this->GetEmailContact($idUser, EnumEssential::EMPLOYEE);
        }
        public function GetEmailContact($idUser, $idTypeUser) {
            return $this->GetContactUser($idUser, $idTypeUser, EnumTypeContacts::TypeEmail);
        }

        public function GetContactUser($idUser, $idTypeUser, $idTypeContact) {
            $contact = $this->GetRowBySql("idOwner=".$idUser." AND idOwnerEssential=".$idTypeUser." AND idType=".$idTypeContact." AND isDeleted=0");
            if ($contact instanceof Contact)
                return $contact->strText;
            return "";
        }
        public function GetAlllowedContact($idUser, $idTypeUser, $idTypeContact) {
            $contact = $this->GetRowBySql("idOwner=".$idUser." AND idOwnerEssential=".$idTypeUser." AND idType=".$idTypeContact." AND isAllow=1 AND isDeleted=0");
            if ($contact instanceof Contact)
                return $contact->strText;
            return "";
        }


        public function SaveVKToClient($strText, $idClient) {
            return $this->SaveClientContact($idClient, EnumTypeContacts::TypeVK, $strText);
        }
        public function SavePhoneToClient($strText, $idClient) {
            return $this->SaveClientContact($idClient, EnumTypeContacts::TypePhone, $strText);
        }
        public function SaveEmailToClient($strText, $idClient) {
            return $this->SaveClientContact($idClient, EnumTypeContacts::TypeEmail, mb_strtolower($strText));
        }
        public function SaveClientContact($idClient, $idType, $strText) {
            return $this->SaveUserContact($idClient, EnumEssential::CLIENTS, $idType, $strText);
        }

        
        public function SaveVKToEmployee($strText, $idEmployee) {
            return $this->SaveEmployeeContact($idEmployee, EnumTypeContacts::TypeVK, $strText);
        }
        public function SavePhoneToEmployee($strText, $idEmployee) {
            return $this->SaveEmployeeContact($idEmployee, EnumTypeContacts::TypePhone, $strText);
        }
        public function SaveEmailToEmployee($strText, $idEmployee) {
            return $this->SaveEmployeeContact($idEmployee, EnumTypeContacts::TypeEmail, mb_strtolower($strText));
        }
        public function SaveEmployeeContact($idEmployee, $idType, $strText) {
            return $this->SaveUserContact($idEmployee, EnumEssential::EMPLOYEE, $idType, $strText);
        }

        
        //  Добавление юзера в список контактов
        public function SaveUserContact($idUser, $idTypeUser, $idTypeContact, $strText) {
            $contact = new Contact();
            
            //  Проверить, что уже существует этот тип контакта. Не корректно сработает для последующих того же типа.
            $contact->id = $this->GetIdByContact($idUser, $idTypeUser, $idTypeContact);
            
            $contact->idOwner = $idUser;
            $contact->idOwnerEssential = $idTypeUser;
            $contact->idType = $idTypeContact;
            if ($idTypeContact == EnumTypeContacts::TypePhone)  $contact->SetPhoneNumber($strText);
            else                                                $contact->strText = $strText;
            $contact->isAllow = 1;
            $contact->isDeleted = 0;
            
            if (! empty($strText))
                return $this->Save($contact);
            else
                $this->Delete($contact->id);
            
            return $contact;
        }




        public function GetIdClientByVK($strTextContact) {
            return $this->GetIdClientByContact(EnumTypeContacts::TypeVK, $strTextContact);
        }
        public function GetIdClientByEmail($strTextContact) {
            return $this->GetIdClientByContact(EnumTypeContacts::TypeEmail, $strTextContact);
        }
        public function GetIdClientByPhone($strTextContact) {
            return $this->GetIdClientByContact(EnumTypeContacts::TypePhone, $strTextContact);
        }
        //  Поиск id по содержимому юзера Контакта
        public function GetIdClientByContact($idTypeContact, $strTextContact) {
            return $this->GetIdOwnerByContact($idTypeContact, $strTextContact, EnumEssential::CLIENTS);
        }
        public function GetIdEmployeeByContact($idUser, $idTypeContact) {
            return $this->GetIdOwnerByContact($idTypeContact, $strTextContact, EnumEssential::EMPLOYEE);
        }
        protected function GetIdOwnerByContact($idTypeContact, $strTextContact, $idOwnerEssential) { //  А вообще-то надо на префикс разбивать. Сейчас она неправильно работает!!!
            if (!isSet($idTypeContact))    $idTypeContact = 0;
            if (!isSet($idOwnerEssential))    $idOwnerEssential = 0;
            $query = "isDeleted=0 AND idOwnerEssential=".$idOwnerEssential."  AND idType=".$idTypeContact." AND strText LIKE '".$strTextContact."'";
            return $this->GetIntField("idOwner", $query);
        }
        
        
        
        function GetIdByContact($idUser, $idTypeUser, $idTypeContact) {
            if (empty($idUser))    $idUser = 0;
            if (empty($idTypeUser))    $idTypeUser = 0;
            if (empty($idTypeContact))    $idTypeContact = 0;

            //  Проверяем существующий контакт, без учёта его содержимого. Каждый тип контакта может быть только в одном экземпляре.
            $query = "isDeleted=0 AND idOwner=".$idUser." AND idOwnerEssential=".$idTypeUser." AND idType=".$idTypeContact;
            return $this->GetIdField($query);
        }
        
    }

?>