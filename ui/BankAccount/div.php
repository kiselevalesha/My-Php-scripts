<script type = "text/javascript">

    function OnClickOpenFullBankAccount() {
        UIBase.ShowHide("divFullBankAccount", "divShortBankAccount");
        UIBase.HideDiv("divBlockSwitchBankAccount");
    }

</script>

<div id = "divShortBankAccount">
    <a class="linkBlack" href="javascript:void(0);" onclick="OnClickOpenFullBankAccount()">
        <div class = " card-panel">
            <h4>Банковский счёт:</h4>
            <div id="divStrBankAccount"><h6>[не указан]</h6></div>
        </div>
    </a>
    <div align="right" id="divBlockSwitchBankAccount">
        <a href="javascript:void(0);" onclick="OnClickOpenFullBankAccount()">
            <div style="padding:0px; margin: 0px;">
                <div style=" padding: 3px 15px 3px 15px; margin: 0px;"><img src="/images/arrow-down.png" width=20px;></div>
            </div> 
        </a>
    </div>   
</div>        

<br>
<div class = "row card-panel" id = "divFullBankAccount" style="display:none"><br>
    <form class = "col s12" action="">
        
        
        <div class = "row">
           <div class = "input-field col s6">
              <input value = "" id = "BIK" type = "text" class = "active validate" />
              <label for = "BIK" id="_BIK">БИК:</label>
           </div>
           <div class = "input-field col s6">
              <input value = "" id = "INNbank" type = "text" class = "active validate" />
              <label for = "INNbank" id="_INNbank">ИНН банка:</label>
           </div>
        </div>

        <div class = "row">
           <div class = "input-field col s12">
              <input value = "" id = "nameBank" type = "text" class = "active validate" />
              <label for = "nameBank" id="_nameBank">Название банка:</label>
           </div>
        </div>

        <div class = "row">
           <div class = "input-field col s12">
              <input value = "" id = "korAccount" type = "text" class = "active validate" />
              <label for = "korAccount" id="_korAccount">Корреспондентский счёт:</label>
           </div>
        </div>

        <div class = "row">
           <div class = "input-field col s12">
              <input value = "" id = "rasAccount" type = "text" class = "active validate" />
              <label for = "rasAccount" id="_rasAccount">Рассчётный счёт:</label>
           </div>
        </div>
        

        <div class = "row">
           <div class = "input-field col s12">
              <textarea id="descriptionBankAccount" class="materialize-textarea"></textarea>
              <label for = "descriptionBankAccount" id="_descriptionBankAccount">Комментарий:</label>
           </div>
        </div>

    </form>
</div>

