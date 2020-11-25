<script type = "text/javascript">

    function OnClickDelete() {
        if (confirm("<? echo $strTitleDelete; ?>")) {
          RunAjax(JSON.stringify({token: strToken, id:id, ids: [+id]}), strUrlAPI + "delete.php", OnResponseDelete);
        }
    }
    function OnResponseDelete() {
        if (this.readyState != 4) return;
        LOG("Get OnResponseDelete: "+ this.responseText);
        if (IsItJson(this.responseText)) {
            var json = JSON.parse(this.responseText);
            if (+json.status.id == 200)   GotoBackPage();
        }
    }

</script>


<div class = "row">
    
    <div class = "col s2">
        <div align="left">
            <a href="javascript:void(0);" onclick="OnClickDelete()">
                <img src="/images/trash.png" width=50px;>
            </a>
        </div>
    </div>
    
    <div class = "col s10">
        <div align="center" style="display:none;" id="divWaitNext">
            <img src="/images/progress1.gif">
        </div>

        <div align="right" id="divNextButton">
            <a class="linkWhite" href="javascript:void(0);" onclick="OnClickSave()">
                <div style="background-Color:black; color:white;display: inline-block; padding: 5px 20px 5px 20px; margin: 0px;"><h5>Сохранить</h5></div>
            </a>
        </div>
    </div>
</div>
