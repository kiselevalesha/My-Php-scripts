<?
    require_once('../php-scripts/db/dbSqlDbUser.php');

    class DBSqlDbClient extends DBSqlDBUser {

        public function __construct() {
            parent::__construct();
            //$this->DropTable("SqlDbClients", "");
            $this->Init("SqlDbClients", "");
        }
    }
?>