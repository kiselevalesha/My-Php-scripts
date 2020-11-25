<?

class AssistentText
{
    public $id= 0;
    public $strTitle = '';
    public $strDescription = '';
    public $strComment = '';
    public $isClicked = 0;
    public $isViewed = 0;
    
    public function ToJson() {
        return '{"id":"'.$this->id.'",'
            .'"title":"'.$this->strTitle.'",'
            .'"description":"'.$this->strDescription.'",'
            .'"comment":"'.$this->strComment.'",'
            .'"isClicked":"'.$this->isClicked.'",'
            .'"isViewed":"'.$this->isViewed.'"}';
    }
}
?>