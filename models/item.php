<?
class Item
{
    public $id = 0;
    public $strName = '';

    public function ToJson() {
        return '{"id":'.$this->id.',"name":"'.$this->strName.'"}';
    }
}
?>