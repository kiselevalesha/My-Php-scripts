<?php

    require_once('../php-scripts/models/essential.php');
    require_once('../php-scripts/db/dbHistories.php');


    $strJsonHistories = "";
    $strJsonRows = "";

    $dbHistory = new DBHistory($idDB);


    function GetJsonsMarked($arrayIds, $idEssential, $valueIsDeleted=1) {
        global $strJsonHistories, $strJsonRows;
        $strJsonHistories = GetJsonHistories($arrayIds, $valueIsDeleted);
        $strJsonRows = GetJsonRows($arrayIds, $idEssential, $valueIsDeleted);
    }
    function GetJsonHistories($arrayIds, $valueIsDeleted=1) {
        $strJsonHistories = "";
            foreach($arrayIds as $id)
                $strJsonHistories .= ',{"id":'.$id.',"isDeleted":'.$valueIsDeleted.'}';
        return substr($strJsonHistories, 1);
    }
    function GetJsonRows($arrayIds, $idEssential, $valueIsDeleted=1) {
        $strJsonRows = "";
            foreach($arrayIds as $id)
                $strJsonRows .= ',{"id":'.$id.',"essential":'.$idEssential.',"isDeleted":'.$valueIsDeleted.'}';
        return substr($strJsonRows, 1);
    }



    function SetDeletedByArraySqlWheres($arrayWheres, $dbTable, $valueIsDeleted=1) {
        $arrayIds = array();
        if (isSet($arrayWheres))
            foreach($arrayWheres as $sqlWhere) {
                $id = MarkDeletedBySql($sqlWhere, $dbTable, $valueIsDeleted);
                array_push($arrayIds, $id);
            }
        return $arrayIds;
    }
    function MarkDeletedBySql($sqlWhere, $dbTable, $valueIsDeleted=1) {
        $id = $dbTable->GetIdField($sqlWhere);
        return MarkDeletedById($id, $dbTable, $valueIsDeleted);
    }

    function SetDeletedByArrayIds($arrayIds, $dbTable, $valueIsDeleted=1) {
        if (isSet($arrayIds))
            foreach($arrayIds as $id)
                MarkDeletedById($id, $dbTable, $valueIsDeleted);
    }
    function MarkDeletedById($id, $dbTable, $valueIsDeleted=1) {
        $dbTable->Delete($id, $valueIsDeleted);
        return $id;
    }



    function GetArrayIds($arrayObjects) {
        $arrayIds = array();
        if (isSet($arrayObjects))
            foreach($arrayObjects as $id)
                if ($id > 0)
                    array_push($arrayIds, $id);
        return $arrayIds;
    }
    function GetJsonListRows($arrayIds, $dbTable, $sqlWhereAdd='', $offset=0, $maximum=0) {
        $sqlWhere = GetSQLSetOfIds($arrayIds, "");
        if (strlen($sqlWhereAdd) > 0)
            if (strlen($sqlWhere) > 0)
                $sqlWhere .= " AND ".$sqlWhereAdd;
        return $dbTable->GetJsonRows($sqlWhere, $offset, $maximum);
    }


    function GetJsonNew($dbTable, $parameter1=null, $parameter2=null, $parameter3=null) {
        $obj = $dbTable->New($parameter1, $parameter2, $parameter3);
        return '{'.$dbTable->MakeJson($obj).'}';
    }
    
    function GetLimitOffset($request) {
        $offset = 0;
        if (isSet($request))
            if (isSet($request->limit))
                if (isSet($request->limit->offset)) $offset = GetInt($request->limit->offset);
        return $offset;
    }
    function GetLimitMaximum($request) {
        $maximum = 0;
        if (isSet($request))
            if (isSet($request->limit))
                if (isSet($request->limit->maximum)) $maximum = GetInt($request->limit->maximum);
        return $maximum;
    }


    
    function GetJsonObjectRows($arrayObjs) {
        $strJson = '';

        if ($arrayObjs != null)
            foreach($arrayObjs as $obj) {
                if (! empty($strJson)) $strJson .= ',';
                $strJson .= '{'.$obj->strJson.'}';
            }

        return $strJson;
    }
    function GetJsonUpdate($arrayObjs, $strTableName) {
        $strJson = '';

        foreach($arrayObjs as $obj) {
            if (! empty($strJson)) $strJson .= ',';
            $strJson .= '{'.$obj->strJsonUpdate.'}';
        }
        
        if (! empty($strJson))
            $strJson = '{"name":"'.$strTableName.'","rows":['.$strJson.']}';

        return $strJson;
    }

?>