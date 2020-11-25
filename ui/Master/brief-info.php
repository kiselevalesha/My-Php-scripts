<script type = "text/javascript">

    function GetDivBlockBriefMaster(master) {
        var strMasterPhoto = '';
        if (master.photo != undefined)
            if (master.photo.length > 0) {
                var strPathFile = master.photo;
                if ((strPathFile.indexOf("https://") == 0) || (strPathFile.indexOf("http://") == 0)) {}
                else    strPathFile = "https://записи.онлайн/" + strPathFile;
                strMasterPhoto = '<div align="center"><img src="' + strPathFile + '" class="avatar77"></div>';
            }

        var strMasterFIO = '';
        if (master.name != undefined)
            if (master.name.length > 0)
                strMasterFIO = '<div align="center"><h5>' + master.name + '</h5></div>';
        
        var strMasterSpecialization = '';
        if (master.specialization != undefined)
            if (master.specialization.length > 0)
                strMasterSpecialization = '<div align="center"><b>' + master.specialization + '</b></div>';
        
        var strDivShort = strMasterPhoto + strMasterFIO + strMasterSpecialization;
        if (strDivShort.length > 0) {
            SetValue("briefMasterData", strDivShort);
            ShowDiv("divBriefMaster");
        }
        
        
        
        var strMasterDescription = '';
        if (master.description != undefined)
            if (master.description.length > 0)
                strMasterDescription = '<div align="center"><h5>' + master.description + '</h5></div>';
        
        var strMasterAdress = '';
        if (master.adress != undefined) {
            var adress = master.adress;
            if (adress.city != undefined)
                if (adress.city.length > 0)     strMasterAdress = 'г.' + adress.city.trim();
            if (adress.street != undefined)
                if (adress.street.length > 0) {
                    if (strMasterAdress.length > 0) strMasterAdress = strMasterAdress + ', ';
                    strMasterAdress = strMasterAdress + 'ул.' + adress.street.trim();
                }
            if (adress.house != undefined)
                if (adress.house.length > 0) {
                    if (strMasterAdress.length > 0) strMasterAdress = strMasterAdress + ', ';
                    strMasterAdress = strMasterAdress + 'д.' + adress.house.trim();
                }
            if (adress.corpus != undefined)
                if (adress.corpus.length > 0) {
                    if (strMasterAdress.length > 0) strMasterAdress = strMasterAdress + ', ';
                    strMasterAdress = strMasterAdress + 'корп.' + adress.corpus.trim();
                }
            if (adress.appartment != undefined)
                if (adress.appartment.length > 0) {
                    if (strMasterAdress.length > 0) strMasterAdress = strMasterAdress + ', ';
                    strMasterAdress = strMasterAdress + 'кв.' + adress.appartment.trim();
                }
            
            strMasterAdress = strMasterAdress.trim();
            if (strMasterAdress.length > 0)
                strMasterAdress = '<br><div align="center"><h6>' + strMasterAdress + '</h6></div>';
        }
        
        var strMasterPhone = '';
        if (master.phone != undefined)
            if (master.phone.length > 0)
                strMasterPhone = '<div align="center"><a href="tel://' + master.phone + '" class="linkBlack"><h5><i style="font-size:120%;" class = "material-icons prefix">phone</i> ' + master.phone + '</h5></a></div>';

        var strDivFull = strMasterDescription + strMasterPhone + strMasterAdress;
        //LOG(strDivFull)
        if (strDivFull.length > 0) {
            SetValue("divAdditionData", strDivFull);
            ShowDiv("divBlockSwitchMaster");
        }
    }

    function OnClickOpenFullMaster() {
        ShowHide("divAdditionData", "divBlockSwitchMaster");
    }
    
</script>
<div id = "divBriefMaster" style="display:none;">
    <div class = "card-panel">
    
        <div id = "briefMasterData"></div>
    
        <div style="display:none;" id="divAdditionData">
    
            <br>
            <div style="display:inline-block;">
                <i class = "material-icons prefix">phone_iphone</i>
                <div align="center" id = "phone">
                    <b> </b>
                </div>
            </div>
            <div align="center" id = "description"> </div>
    
        </div>
    </div>
    
    <div align="right" style="display:none;" id="divBlockSwitchMaster">
        <a href="javascript:void(0);" onclick="OnClickOpenFullMaster()">
            <div style="padding:0px; margin: 0px;">
                <div style=" padding: 3px 15px 3px 15px; margin: 0px;"><img src="/images/arrow-down.png" width=20px;></div>
            </div> 
        </a>
    </div>   
</div>
