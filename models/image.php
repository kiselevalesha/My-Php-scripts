<?
include_once('../php-scripts/models/base.php');
include_once('../php-scripts/models/essential.php');
include_once('../php-scripts/models/sites.php');

class Image extends Base
{
    public $idSite = 0;  //  Если это внешний сайт, то сохраняется полная ссылка. Если свой - то короткая.
    public $idEssential = 0;
    public $idOwner = 0;
    public $strName = '';
    public $strDescription = '';
    public $strDescriptionOnline = '';
    public $strUrl = '';
    public $intFileSize = 0;
    public $isPublish = 0;
    public $isShowOnline = 0;
    public $isMainInSequence = 0;
    public $isUseInPortfolio = 0;
    public $isNew = 1;
    public $ageCreated = 1;

    public function MakeJson() {
        $essential = new EnumEssential();
        return '"id":'.$this->id.','
            //.'"site":'.$this->idSite.','
            .'"url":"'.$this->GetFullPath().'",'
            .'"ageCreated":'.$this->ageCreated.','
            .'"name":"'.$this->strName.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"descriptionOnline":"'.$this->strDescriptionOnline.'",'
            //.'"essential":{"id":'.$this->idEssential.',"name":"'.$essential->GetNameEssentialRussian($this->idEssential).'"},'
            .'"essential":{"id":'.$this->idEssential.'},'
            .'"owner":'.$this->idOwner .','
            .'"isPublish":'.$this->isPublish .','
            .'"isShowOnline":'.$this->isShowOnline .','
            .'"isDeleted":'.$this->isDeleted .','
            .'"isMainInSequence":'.$this->isMainInSequence .','
            .'"isUseInPortfolio":'.$this->isUseInPortfolio;
    }
    
    public function GetFullPath() {
        return Sites::GetFullPath($this->idSite, $this->strUrl);
    }
}
?>