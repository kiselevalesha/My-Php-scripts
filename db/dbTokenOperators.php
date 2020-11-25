<?
    require_once('../php-scripts/db/dbTokenUser.php');

    class DBTokenOperator extends dbTokenUser {

        public function __construct() {
            parent::__construct();
            //$this->DropTable("TokensOperator", "");
            $this->Init("TokensOperator", "");
        }
    }
?>