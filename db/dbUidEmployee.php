<?
    include_once('../php-scripts/db/dbUidUsers.php');

    class DBUidEmployee extends DBUidUser {

        public function __construct() {
            parent::__construct();
            //$this->DropTable("UidEmployee", "");
            $this->Init("UidEmployee", "");
        }
        
    }
?>