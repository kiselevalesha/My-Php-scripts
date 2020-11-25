<?
    //  тут будет ещё к привязка к employee

    require_once('../php-scripts/models/essential.php');
    require_once('../php-scripts/db/dbProducts.php');
    $dbProduct = new DBProduct($idDB);

    require_once('../php-scripts/db/dbPricelists.php');
    $dbPricelist = new DBPricelist($idDB);
    $idPricelist = GetInt($json->pricelist);
    if (empty($idPricelist))    $idPricelist = $dbPricelist->GetIdDefault();

    require_once('../php-scripts/db/dbPricelistContents.php');
    $dbPricelistContent = new DBPricelistContent($idDB);
    
    require_once('../php-scripts/db/dbImages.php');
    $dbImage = new DBImage($idDB);

    $idService = GetInt($json->id);
    $strJson = "";
    
    $arrayContents = $dbPricelistContent->GetArrayRows("idPricelist=".$idPricelist." AND isDeleted=0 AND idEssential=".EnumEssential::SERVICES);
    if (!empty($idService))    $sqlWhere .= " AND idProduct=".$idService;
    foreach ($arrayContents as $content) {
        if (!empty($content->idProduct)) {
            $product = $dbProduct->Get($content->idProduct);

            $photo = "";
            if ($product->idMainPhoto > 0) {
                $image = $dbImage->Get($product->idMainPhoto);
                $photo = $image->strUrl;
            }
            
            $strJsonGroups = '';
            $strJsonCategory = '';
            $strJsonDetails = '';
            //  Если запрашивается единичный продукт, а не список
            if ($idService > 0) {
                // Найдём все группы
                $arrayGroups = $dbOwnerGroup->GetArrayGroups($product->id, EnumEssential::SERVICES);
                foreach($arrayGroups as $group) {
                    if (!empty($strJsonGroups)) $strJsonGroups .= ',';
                    $strJsonGroups .= '{"id":"'.$group->id.'","name":"'.$group->name.'"}';
                }
                $strJsonGroups = ',"groups":['.$strJsonGroups.']';
        
                // Найдём категорию
                if ($product->idCategory > 0) {
                    $category = $dbCategory->Get($product->idCategory);
                    $strJsonCategory = ',"category":{"id":"'.$category->id.'","name":"'.$category->strName.'"}';
                }
                
                $strJsonDetails = '"usePeriod":"'.$service->intUsePeriod.'","isForWoman":"'.$service->isForWoman.'","isForMan":"'.$service->isForMan
                    .'","isForChildren":"'.$service->isForChildren.'","isShowOnline":"'.$service->isShowOnline.'","isUse":"'.$service->isUse.'"';
            }

            if (strlen($strJson) > 0)   $strJson .= ",";
            $strJson .= '{"id":'.$product->id.',"name":"'.$product->strName.'","description":"'.$product->strDescription.'","photo":"'.$photo.'","cost":"'.$content->costForSale.'","duration":'.$content->intDurationMinutes
                .$strJsonGroups.$strJsonCategory.$strJsonDetails.'}';
        }
    }

    echo GetOutJson('"services":['.$strJson.']');
?>