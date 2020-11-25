<?
    include_once('../php-scripts/db/dbUidUsers.php');

    class DBUidClient extends DBUidUser {

        public function __construct() {
            parent::__construct();
            //$this->DropTable("UidClients", "");
            $this->Init("UidClients", "");
        }
        
    }
?>