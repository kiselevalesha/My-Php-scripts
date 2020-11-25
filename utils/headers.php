<?
    switch ($_SERVER['REQUEST_METHOD']) {
        case "OPTIONS":
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
            header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
            header("Content-Length: 0");
            exit(0);
            break;
        case "GET":
        case "POST":
            header('Access-Control-Allow-Origin: *');
            break;
    }
    header('Content-Type: application/json; charset="UTF-8"');


    $body = file_get_contents('php://input');
    $request = json_decode($body, false, 32);

    
    if (empty($strToken))   $strToken = GetCleanString($request->token);   //  Так надо! empty не удаляй!!!
    if (empty($strToken))   ExitEmptyError("Token is empty!");


    require_once('../php-scripts/db/dbTokenEmployee.php');
    $dbTokenEmployee = new DBTokenEmployee();
    $idDB = $dbTokenEmployee->GetIdDbByToken($strToken);


    //  Сохраним в логах переданный json
    if (! empty($body)) {
        require_once '../php-scripts/db/dbLogs.php';
        $dbLog = new DBLog($idDB);
        $dbLog->Add(1001, $body);
    }
?>