    <div style="display:none;" id="divPageServices">

        <div id = "divHelp">     
        <?
            $strDescription = "Укажите название услуги, её продолжительность в минутах и цену в рублях и нажмите на кнопку <b>Добавить</b>.";
            GetDivHelpInfo($strDescription);
        ?>
        </div> 
            
        <div id="divListOfServices"></div>    
    
        <br>
        <div class = "row card-panel">
            <form class = "col s12">
    
                <div class = "row">
                   <div class = "input-field col s12">
                      <i class = "material-icons prefix">add_shopping_cart</i>
                      <textarea id = "nameService" class = "materialize-textarea" required></textarea>
                      <label for = "nameService" id="_nameService">Название услуги:</label>
                   </div>
                </div>
    
                <div class = "row">
                   <div class = "input-field col s6">
                      <i class = "material-icons prefix">alarm</i>
                      <input  value = "" id = "durationService" type = "text" class = "active validate" required />
                      <label for = "durationService" id="_durationService">Время:</label>
                   </div>
                   
                   <div class = "input-field col s6">
                      <i class = "material-icons prefix">account_balance_wallet</i>
                      <input value = "" id = "costService" type = "text" class = "active validate" required />
                      <label for = "costService" id="_costService">Цена:</label>
                   </div>
                </div>
    
                <div class="row">
                    <div align="center" id="divBlockAddService">
                        <a class="linkWhite" href="javascript:void(0);" onclick="OnClickAddService()">
                            <div style="background-Color:black; color:white;display: inline-block; padding: 2px 20px 2px 20px; margin: 0px;"><h5>Добавить</h5></div>
                        </a>
                    </div>
                    
                    <div align="center" id="divWaitAddService" style="display:none;">
                        <img src="/images/progress1.gif" width=50px;>
                    </div>
                </div>
                
             </form>
        </div>

    </div>