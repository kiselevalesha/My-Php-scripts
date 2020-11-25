<?
include_once('../php-scripts/models/base.php');

//  Тип контента каждой строки в таблице
abstract class EnumTypeContents {
    const TypeContentNone = 0;
    const TypeContentText = 1;
    const TypeContentLink = 2;
    const TypeContentImage = 3;
    const TypeContentVideo = 4;
    const TypeContentAudio = 5;
    const TypeContentHTML = 6;
    const TypeContentCommand = 7;
}

//  Тип того как контент интерпретировать - Просто текстовое сообщение, медийное сообщение (могут получать только некоторые каналы отправки), голосовое - звонок роботом.
abstract class EnumTypeMessage {
    const TypeMessageText = 1;      //  SMS
    const TypeMessageMedia = 2;     //  MMS
    const TypeMessageVoice = 3;     //  голосовое сообщение роботом
    const TypeMessageInteractive = 4;   //  робот-чатбот    -   Это ещё не реализовано и сделано с заделом на будущее
}

//  Используемый канал доставки сообщения
abstract class EnumTypeChannels {
    const TypeChannelNone = 0;      //  Если канал не задан, то при отправке сообщения ищется доступный дешевый разрешённый канал
    const TypeChannelChat = 1;
    const TypeChannelPush = 2;
    const TypeChannelEmail = 3;
    const TypeChannelPhone = 4;     //  SMS, MMS, Whatsapp, Viber, VK
    const TypeChannelSmsMms = 5;    //  SMS, MMS - в зависимости от EnumTypeMessage (Text/Media)
    const TypeChannelWhatsapp = 6;
    const TypeChannelViber = 7;
    const TypeChannelTwitter = 8;
    const TypeChannelFacebook = 9;
    const TypeChannelVk = 10;
}

abstract class EnumTypeError {
    const TypeErrorLackMoney = 1;       //  Не хватает денег на балансе
    const TypeErrorCanNotReceived = 2;  //  Не получается доставить сообщение получателю
    const TypeErrorSenderError = 3;    //  Ошибка от доставителя сообщения
    const TypeErrorNoEmail = 4;         //  Не указан email получателя
}

class Message extends Base
{
    public $idTalk = 0;
    public $idAppointment = 0;      //  Много сообщений связано с тем или иным Appointment. (Но не всегда.) Использую, при создании сообщений по Правилам, чтобы избежать дублей.
    public $ageChanged = 0;

    public $isApproved = 0;         //  Создано ли сообщение по одобренному правилу
    public $idTypeContent = 0;      //  Тип сонтента сообщения  ::EnumTypeContents
    public $strBody = '';           //  Текст сообщения, адрес ссылки/файла, команда
    public $strBodyOut = '';        //  Отосланный текст сообщения. Может быть как Html

    public $idUser = 0;             //  4-ре поля используются для идентификации отсылающего в системе
    public $idEssential = 0;
    public $strUidUser = '';
    public $intCodeUidUser = 0;

    public $isOptimizationCost = 1; //  Использовать ли алгоритм отсылки сначала по самым дешёвым канал последовательно к самым дорогим. Или просто отправлять по указанному ниже каналу. По умолчанию это смс.
    public $idTypeChannel = 0;      //  канал, через который отправится/отправилось сообщение: SMS, VK, Wiber, Whatsapp... ::EnumTypeChannels
    public $strAdress = '';         //  номер телефона или любой идентификатор - куда и кому отсылать

    public $ageWillSend = 0;        //  дата и время планируемой отправки сообщения
    public $ageWasSended = 0;       //  дата и время фактической отправки сообщения
    public $ageIncome = 0;          //  дата и время получения входящего сообщения
    
    public $idMessageRule = 0;      //  если сообщение создаётся из заданного правила создания сообщений, то это идентификатор. Проверяется на повтор в связке с $idAppointment.
    //public $strMessageRule = '';    //  этого поля нет в талице!!! Оно нужно лишь для генерации json !!!
    public $idReport = 0;           //  Если в сообщении высылается генерируемый отчёт
    public $idTypeMessage = 0;      //  текстовое, медийное (аудио/видео) или голосовое сообщение :: EnumTypeMessage


    public $isNew = 1;
    public $isHidden = 0;
    public $isDraft = 1;            //  Некоторые сообщения создаются автоматически (например, при создании Записи), а потом ждут момента, когда станут действительными (когда сохранят новую Запись). Поэтому в начале они висят в статусе Черновик.
    public $isManualEdited = 0;     //  Было ли сообщение создано автоматически ($idMessageRule) и потом вручную изменено

    public $cost = 0;               //  Стоимость отправки сообщения
    public $idTypeError = 0;        //  Если случилась ошибка при отправке сообщения  ::EnumTypeError
    public $idSenderError = 0;      //  Если доставитель вернул ошибку. Её номер здесь.
    public $strSenderError = '';    //  Описание ошибки, полученное от доставителя.
    public $costSender = 0; 
    
    public $strIdSigmaMessage = ''; //  Идентификатор, получаемый от рассылщика Sigma


    public function MakeJson() {
        return 
             '"id":'.$this->id.','
            .'"isApproved":'.$this->isApproved.','
            .'"content":'.$this->idTypeContent.','
            .'"user":"'.$this->strUidUser.'",'
            .'"side":"'.$this->idEssential.'",'

            .'"age":{'
                .'"will":'.$this->ageWillSend.','
                .'"was":'.$this->ageWasSended.','
                .'"in":'.$this->ageIncome.'},'

            //.'"rule":{'
            //    .'"id":'.$this->idMessageRule.','
            //    .'"name":"'.$this->strMessageRule.'"},'

            .'"channel":'.$this->idTypeChannel.','
            .'"adress":"'.$this->strAdress.'",'
            
            .'"idTypeMessage":'.$this->idTypeMessage.','
            .'"isManualEdited":'.$this->isManualEdited.','
            .'"isDraft":'.$this->isDraft;
    }
    public function MakeJsonBody() {
        
        if ($this->idTypeMessage == EnumTypeMessage::TypeMessageMedia)
            $media = $this->EscapeValue($this->strBodyOut);
        else
            $media = $this->strBodyOut;
            
            //$media = $this->CleanValue($this->strBodyOut);
        
        return 
             '"id":'.$this->id.','
            .'"body":"'.$this->strBody.'",'
            .'"media":"'.$media.'",'
            .'"cost":'.$this->cost.','
            
            .'"isApproved":'.$this->isApproved.','
            .'"content":'.$this->idTypeContent.','
            .'"user":"'.$this->strUidUser.'",'
            .'"side":"'.$this->idEssential.'",'

            .'"age":{'
                .'"will":'.$this->ageWillSend.','
                .'"was":'.$this->ageWasSended.','
                .'"in":'.$this->ageIncome.'},'

            //.'"rule":{'
            //    .'"id":'.$this->idMessageRule.','
            //    .'"name":"'.$this->strMessageRule.'"},'

            .'"channel":'.$this->idTypeChannel.','
            .'"adress":"'.$this->strAdress.'",'
            
            .'"idTypeMessage":'.$this->idTypeMessage.','
            .'"isDraft":'.$this->isDraft;
    }
}

?>