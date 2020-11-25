<?
    header('Content-Type: application/json; charset="UTF-8"');
    require_once '../php-scripts/utils/json.php';

    $body = file_get_contents('php://input');
    $json = json_decode($body, false, 32);

    
    if (empty($strToken))   $strToken = GetCleanString($json->token);   //  Так надо! empty не удаляй!!!
    if (empty($strToken))   ExitEmptyError("Token is empty!");

    require_once('../php-scripts/db/dbTokenEmployee.php');
    $dbTokenEmployee = new DBTokenEmployee();
    $idDB = $dbTokenEmployee->GetIdDbByToken($strToken);


    //  Сохраним в логах переданный json
    require_once '../php-scripts/db/dbLogs.php';
    $dbLog = new DBLog($idDB);
    $dbLog->Add(1001, $body);
?>