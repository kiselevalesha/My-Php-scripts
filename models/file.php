<?
include_once('../php-scripts/models/base.php');

class File extends Base
{
    public $strFile = '';               //  новое сгенерированное имя файла
    public $strSourceNameFile = '';     //  имя загруженного файла
    
    public $idType = 0;         //  тип файла
    public $idFolder = 0;       //  id папки, куда был загружен файл
    public $idSite = 0;         //  id сайта, куда был загружен файл
    public $idApp = 0;          //  id приложения, из которого загружен
    
    public $isMain = false;     //  главное ли фото в сиквенции
    public $isDeleted = false;  //  удалён ли файл

    public $strUrlUploaded = '';    //  url, откуда был загружен
    public $dateTimeCreated = 0;    //  дата и время загрузки
    
    
    public function GetFileName() {
        return $this->$strFile;
    }
}

?>