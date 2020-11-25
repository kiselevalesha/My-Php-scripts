
<? require_once '../js-scripts/adress.php'; ?>

<div id = "divShortAdress">
    <a class="linkBlack" href="javascript:void(0);" onclick="OnClickOpenFullAdress()">
        <div class = " card-panel">
            <h4>Адрес:</h4>
            <div id="divStrAdress"><h6>[не указан]</h6></div>
        </div>
    </a>
    <div align="right" id="divBlockSwitchAdress">
        <a href="javascript:void(0);" onclick="OnClickOpenFullAdress()">
            <div style="padding:0px; margin: 0px;">
                <div style=" padding: 3px 15px 3px 15px; margin: 0px;"><img src="/images/arrow-down.png" width=20px;></div>
            </div> 
        </a>
    </div>   
</div>        

<br>
<div class = "row card-panel" id = "divFullAdress" style="display:none"><br>
    <form class = "col s12" action="">
        
        
        <div class = "row">
           <div class = "input-field col s6">
              <input value = "" id = "city" type = "text" class = "active validate" />
              <label for = "city" id="_city">Город:</label>
           </div>
           <div class = "input-field col s6">
              <input value = "" id = "index" type = "text" class = "active validate" />
              <label for = "index" id="_index">Индекс:</label>
           </div>
        </div>

        <div class = "row">
           <div class = "input-field col s12">
              <input value = "" id = "street" type = "text" class = "active validate" />
              <label for = "street" id="_street">Улица:</label>
           </div>
        </div>
        
        <div class = "row">
           <div class = "input-field col s4">
              <input value = "" id = "house" type = "text" class = "active validate" />
              <label for = "house" id="_house">Дом:</label>
           </div>
           <div class = "input-field col s4">
              <input value = "" id = "corpus" type = "text" class = "active validate" />
              <label for = "corpus" id="_corpus">Корпус:</label>
           </div>
           <div class = "input-field col s4">
              <input value = "" id = "appartment" type = "text" class = "active validate" />
              <label for = "appartment" id="_appartment">Квартира:</label>
           </div>
        </div>

        <div class = "row">
           <div class = "input-field col s12">
              <textarea id="descriptionAdress" class="materialize-textarea"></textarea>
              <label for = "descriptionAdress" id="_descriptionAdress">Как добраться:</label>
           </div>
        </div>
        
    </form>
</div>

