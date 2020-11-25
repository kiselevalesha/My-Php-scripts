<div id="divOldMessages"></div>
<div id="divCurrentMessages"></div>

<br>
<div id="divBlockEdit" class = "row card">
    <form class = "col s12">
    
        <div class = "row">
           <div class = "input-field col s12">
              <i class = "material-icons prefix">chat</i>
              <textarea id = "talkMessage" class = "materialize-textarea" placeholder = "<? echo $strMessage; ?>"></textarea>
              <label for = "talkMessage" id = "_talkMessage"></label>
           </div>
        </div>
    
        <div class = "row">
            <div class = "input-field col s2">
                <div id="divButtonAddPhoto" style="display:none">
                    <a id="upload" class="btn-floating black btn-large waves-effect waves-light" href="javascript:void(0);" onclick="OnClickAddChatPhoto()"><i class="material-icons" style="font-size:2.2em;">add_a_photo</i></a>    
                    <input type='file' style="display:none" accept="image/*" id="listImageFiles" capture onchange="OnChangeTalkInputFile()">
                </div>
            </div>
            <div class = "input-field col s10" align="right">
                <a class="waves-effect black waves-light btn" href="javascript:void(0);" onclick="OnClickSendMessage()"><i class="material-icons left">send</i>Отправить</a>
            </div>
        </div>

    </form>
</div>

<div id="divWaitTalk" class = "row card" align="center" style="display:none;">
    <br><br><br><br>
        <img src="/images/progress1.gif" width=50px;>
    <br><br><br><br>
</div>

<div id="divFutureMessages"></div>
