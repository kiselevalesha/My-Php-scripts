<?
    require_once('../php-scripts/db/dbTokenUser.php');

    class DBTokenEmployee extends dbTokenUser {

        public function __construct() {
            parent::__construct();
            //$this->DropTable("TokensEmployee", "");
            $this->Init("TokensEmployee", "");
        }
    }
?>